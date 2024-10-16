<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(FournisseursSeeder::class);
        $this->call(UnspscSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CoordonneSeeder::class);
        $this->call([ResponsablesSeeder::class,
        ]);
    }
}
