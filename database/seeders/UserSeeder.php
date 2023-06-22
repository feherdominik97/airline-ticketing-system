<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        for ($i = count($users); $i < 10; $i++){
            DB::table('users')->insert([
                'name' => "user$i",
                'email' => "user$i@gmail.com",
                'password' => Hash::make('password'),
            ]);
        }
    }
}
