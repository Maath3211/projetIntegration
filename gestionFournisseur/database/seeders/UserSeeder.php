<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Math',
            'email'=> 'mathys.lessard.02@edu.cegeptr.qc.ca',
            'role' => 'admin',
            'password' =>Hash::make('adminggg')
        ]);
    }
}
