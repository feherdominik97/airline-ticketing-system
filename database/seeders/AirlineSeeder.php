<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = DB::table('airlines');
        Schema::disableForeignKeyConstraints();
        $table->delete();
        Schema::enableForeignKeyConstraints();
        $airlines = [
            [
                'name' => 'Delta Air Lines'
            ],
            [
                'name' => 'United Airlines'
            ],
            [
                'name' => 'American Airlines'
            ],
            [
                'name' => 'British Airways'
            ],
            [
                'name' => 'Emirates'
            ],
            [
                'name' => 'Air France'
            ],
            [
                'name' => 'Lufthansa'
            ],
            [
                'name' => 'Qantas Airways'
            ],
            [
                'name' => 'Singapore Airlines'
            ]
        ];

        $table->insert($airlines);
    }
}
