<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_courriel')->insert([
            'id' => 1,
            'nom' => 'Acceptée',
            'sujet' => 'Demande acceptée',
            'contenu' => 'Fournisseur accepté pour la ville'
        ]);
        DB::table('model_courriel')->insert([
            'id' => 2,
            'nom' => 'Refusé',
            'sujet' => 'Demande refusé',
            'contenu' => 'Fournisseur refusé pour la ville'
        ]);
    }
}
