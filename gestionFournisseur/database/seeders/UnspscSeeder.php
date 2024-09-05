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
        DB::table('unspsc')->insert([

        //     [
        //    'code'=>72101504,
        //     'description'=>"Services de prévoyance et de mise à l'épreuve de catastrophe",

        //     ],

        //     [
        //     'code'=>72101506,
        //     'description'=>"Services de maintenance d'ascenseurs",

        //     ],

        //     [
        //         'code'=>72101506,
        //         'description'=>"Services de maintenance d'ascenseurs",
    
        //     ],    
            
        //     [
        //         'code'=>72101504,
        //         'description'=>"Services de prévoyance et de mise à l'épreuve de catastrophe",
     
        //     ],
     
        //     [
        //         'code'=>72101506,
        //         'description'=>"Services de maintenance d'ascenseurs",
     
        //     ],
     
        //     [
        //         'code'=>72101506,
        //         'description'=>"Services de maintenance d'ascenseurs",
         
        //     ], 
            

        ]);
    }
}
