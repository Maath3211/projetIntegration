<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('employes')->insert([
            'id' => 1,
            'email' => 'commis@v3r.net',
            'role' => 'Commis'
        ]);

        DB::table('employes')->insert([
            'id' => 2,
            'email' => 'commis2@v3r.net',
            'role' => 'Commis'
        ]);

        DB::table('employes')->insert([
            'id' => 3,
            'email' => 'responsable@v3r.net',
            'role' => 'Responsable'
        ]);

        DB::table('employes')->insert([
            'id' => 4,
            'email' => 'responsable2@v3r.net',
            'role' => 'Responsable'
        ]);

        DB::table('employes')->insert([
            'id' => 5,
            'email' => 'administrateur@v3r.net',
            'role' => 'Administrateur'
        ]);

        DB::table('employes')->insert([
            'id' => 6,
            'email' => 'administrateur@v3r.net',
            'role' => 'Administrateur'
        ]);
    }
}
