<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class Minimum extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting')->insert([
            'id' => 1,
            'emailAppro'=> 'admin@admin.com',
            'delaiRev' => 24,
            'tailleMax' => 75,
            'emailFinance' => 'admin@admin.com'
        ]);

        DB::table('responsables')->insert([
            'id' => 5,
            'email' => 'Administrateur@v3r.net',
            'role' => 'Administrateur'
        ]);

        
    }
}
