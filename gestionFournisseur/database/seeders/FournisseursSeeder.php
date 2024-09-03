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
            'password' =>Hash::make('adminggg')
        ]);
    }
}
