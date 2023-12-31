<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Airline;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AircraftSeeder::class,
            AirlineSeeder::class,
            FlightSeeder::class,
            SoldTicketSeeder::class
        ]);
    }
}
