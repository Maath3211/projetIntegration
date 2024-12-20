<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('responsables')->insert([
            'id' => 1,
            'email' => 'commis@v3r.net',
            'role' => 'Commis'
        ]);

        DB::table('responsables')->insert([
            'id' => 2,
            'email' => 'commis2@v3r.net',
            'role' => 'Commis'
        ]);

        // DB::table('responsables')->insert([
        //     'id' => 3,
        //     'email' => 'responsable@v3r.net',
        //     'role' => 'Responsable'
        // ]);

        DB::table('responsables')->insert([
            'id' => 4,
            'email' => 'responsable2@v3r.net',
            'role' => 'Responsable'
        ]);

        DB::table('responsables')->insert([
            'id' => 5,
            'email' => 'Administrateur@v3r.net',
            'role' => 'Administrateur'
        ]);

        // DB::table('responsables')->insert([
        //     'id' => 6,
        //     'email' => 'Administrateur2@v3r.net',
        //     'role' => 'Administrateur'
        // ]);
    }
}
