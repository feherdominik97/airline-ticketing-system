<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoldTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $users = User::all()->toArray();
        $flights = Flight::all()->toArray();
        $types = ['Economy', 'Business', 'First-class'];

        $aircraft = [];
        foreach ($flights as $flight){
            $aircraft[] = DB::table('aircraft')->where('id', $flight['aircraft_id'])->value('passenger_limit');
        }

        $soldTickets = [];
        for($i = 0; $i < 1600; $i++){
            $randomFlightAndIndex = $this->getRandomAvailableFlight($flights, $aircraft);
            $aircraft[$randomFlightAndIndex['index']]--;
            $soldTickets[] = [
                'user_id' => $users[random_int(0, count($users) - 1)]['id'],
                'flight_id' => $randomFlightAndIndex['flight']['id'],
                'type' => $types[random_int(0, count($types) - 1)]
            ];
        }

        DB::table('sold_tickets')->insert($soldTickets);
    }

    /**
     * @throws Exception
     */
    private function getRandomAvailableFlight($flights, $aircraft): array
    {
        $randomIndex = random_int(0, count($flights) - 1);

        if ($aircraft[$randomIndex]) {
            return [
                'flight' => $flights[$randomIndex],
                'index' => $randomIndex
            ];
        } else {

            return $this->getRandomAvailableFlight($flights, $aircraft);
        }
    }
}
