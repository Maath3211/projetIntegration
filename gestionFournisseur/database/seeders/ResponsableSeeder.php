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
            'email' => 'commis@commis.com',
            'role' => 'Commis'
        ]);

        DB::table('responsables')->insert([
            'id' => 2,
            'email' => 'commis2@commis.com',
            'role' => 'Commis'
        ]);

        DB::table('responsables')->insert([
            'id' => 3,
            'email' => 'responsable@responsable.com',
            'role' => 'Responsable'
        ]);

        DB::table('responsables')->insert([
            'id' => 4,
            'email' => 'responsable2@responsable.com',
            'role' => 'Responsable'
        ]);

        DB::table('responsables')->insert([
            'id' => 5,
            'email' => 'gestionnaire@rgestionnaire.com',
            'role' => 'Gestionnaire'
        ]);

        DB::table('responsables')->insert([
            'id' => 6,
            'email' => 'gestionnaire2@rgestionnaire.com',
            'role' => 'Gestionnaire'
        ]);
    }
}
