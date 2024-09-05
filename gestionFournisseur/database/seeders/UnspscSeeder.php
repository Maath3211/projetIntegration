<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnspscSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unspsc')->insert([

            [
           'code'=>72101504,
            'description'=>"Services de prévoyance et de mise à l'épreuve de catastrophe",
            'details'=>'Je fais des combinaison spacial'
            ],

            [
            'code'=>72101506,
            'description'=>"Services de maintenance d'ascenseurs",
            'details'=>'Je fais des Ascenseurs'
            ],

        ]);
    }
}
