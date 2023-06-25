<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use App\Models\Airline;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        $table = DB::table('flights');
        Schema::disableForeignKeyConstraints();
        $table->delete();
        Schema::enableForeignKeyConstraints();

        $cities = [
            'New York, United States',
            'London, United Kingdom',
            'Paris, France',
            'Tokyo, Japan',
            'Dubai, United Arab Emirates',
            'Sydney, Australia',
            'Cape Town, South Africa',
            'Rio de Janeiro, Brazil',
            'Bangkok, Thailand',
            'Rome, Italy',
            'Beijing, China',
            'Mumbai, India',
            'Toronto, Canada',
            'Buenos Aires, Argentina',
            'Cairo, Egypt',
            'Moscow, Russia',
            'Auckland, New Zealand',
            'Cancun, Mexico',
            'Barcelona, Spain',
            'Istanbul, Turkey',
        ];

        $airlines = Airline::all()->toArray();
        $aircraft = Aircraft::all()->toArray();
        $flights = [];

        for($i = 0; $i < 300; $i++){
            $flights[] = [
                'airline_id' => $airlines[random_int(0, count($airlines) - 1)]['id'],
                'aircraft_id' => $aircraft[random_int(0, count($aircraft) - 1)]['id'],
                'source' => $cities[random_int(0, count($cities) - 1)],
                'destination' => $cities[random_int(0, count($cities) - 1)],
                'take_off' => date('Y-m-d H:i:s', rand(strtotime('+1 week'), time())),
                'is_cancelled' => false
            ];
        }

        $table->insert($flights);
    }

    /**
     * @throws Exception
     */
    private function getRandomHours(): int|string
    {
        $hours = random_int(0, 23);

        return $hours < 10 ? '0' . $hours : $hours;
    }
}
