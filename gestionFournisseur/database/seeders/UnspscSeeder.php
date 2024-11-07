<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnspscSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chemin vers le fichier CSV
        $csvFile = public_path('csv/unspsc_codes.csv');

        // Ouvrir le fichier en lecture
        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Boucle pour lire chaque ligne
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                // Vérifier et supprimer le BOM dans le premier champ 'nature'
                $data[0] = preg_replace('/^\xEF\xBB\xBF/', '', $data[0] ?? null);

                // Insertion dans la table `unspsc`
                DB::table('unspsc')->insert([
                    'nature' => mb_convert_encoding($data[0] ?? null, 'UTF-8', 'auto'),
                    'code_categorie' => mb_convert_encoding($data[1] ?? null, 'UTF-8', 'auto'),
                    'categorie' => mb_convert_encoding($data[2] ?? null, 'UTF-8', 'auto'),
                    'code' => isset($data[3]) ? (int) $data[3] : null,
                    'description' => mb_convert_encoding($data[4] ?? null, 'UTF-8', 'auto'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Fermer le fichier après lecture
            fclose($handle);
        }
    }
}
