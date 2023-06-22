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
        for($i = 0; $i < 100; $i++){
            $soldTickets[] = [
                'user_id' => $users[random_int(0, count($users) - 1)]['id'],
                'flight_id' => $this->getRandomAvailableFlight($flights, $aircraft)['id'],
                'type' => $types[random_int(0, count($types) - 1)]
            ];
        }

        DB::table('sold_tickets')->insert($soldTickets);
    }

    /**
     * @throws Exception
     */
    private function getRandomAvailableFlight($flights, $aircraft)
    {
        $randomIndex = random_int(0, count($flights) - 1);

        if ($aircraft[$randomIndex]) {
            $aircraft[$randomIndex]--;

            return $flights[$randomIndex];
        } else {

            return $this->getRandomAvailableFlight($flights, $aircraft);
        }
    }
}
