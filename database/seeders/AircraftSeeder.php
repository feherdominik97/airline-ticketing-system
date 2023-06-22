<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AircraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $table = DB::table('aircraft');
        Schema::disableForeignKeyConstraints();
        $table->delete();
        Schema::enableForeignKeyConstraints();

        $aircraft = [
            [
                'name' => "Commercial Jetliner",
                'passenger_limit' => 220,
            ],
            [
                'name' => "Regional Jet",
                'passenger_limit' => 130,
            ],
            [
                'name' => "Turboprop Aircraft",
                'passenger_limit' => 78,
            ],
            [
                'name' => 'Light Aircraft',
                'passenger_limit' => 4,
            ]
        ];

        $table->insert($aircraft);
    }
}
