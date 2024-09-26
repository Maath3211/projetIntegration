<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CoordonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coordonnees')->insert([
            'id' => 1,
            'noCivic' => '2041',
            'rue' => 'St-Charles',
            'bureau' => '3',
            'ville' => 'Sainte-Angèle-de-Prémont',
            'province' => 'Québec',
            'codePostal' => 'J0K1R0',
            'codeRegion' => '1',
            'nomRegion' => 'Mauricie',
            'site' => 'www.qwant.com',
            'typeTel' => 'Cellulaire',
            'numero' => '8192446143',
            'poste' => '2089',
            'fournisseur_id' => 2

        ]);
    }
}
