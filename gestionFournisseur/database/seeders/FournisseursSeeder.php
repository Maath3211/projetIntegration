<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FournisseursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fournisseurs')->insert([
            'id' => 1,
            'email'=> 'admin@admin.com',
            'neq' => '1123456789',
            'entreprise' => 'Cegep',
            'statut' => 'confirme',
            'password' =>Hash::make('adminggg')
        ]);
        DB::table('fournisseurs')->insert([
            'id' => 2,
            'email'=> 'mathys.lessard.02@edu.cegeptr.qc.ca',
            'neq' => '1123456782',
            'entreprise' => 'Cegep',
            'password' =>Hash::make('adminggg')
        ]);
    }
}
