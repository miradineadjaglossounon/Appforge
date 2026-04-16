<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/ModuleSeeder.php
public function run()
{
    DB::table('modules')->insert([
        ['id' => 1, 'name' => 'URL Shortener', 'description' => 'Raccourcir et gérer des liens'],
        ['id' => 2, 'name' => 'Wallet', 'description' => 'Gestion du solde et des transferts'],
        ['id' => 3, 'name' => 'Marketplace + Stock Manager', 'description' => 'Gestion de produits et commandes'],
        ['id' => 4, 'name' => 'Time Tracker', 'description' => 'Suivi des sessions et durées'],
        ['id' => 5, 'name' => 'Investment Tracker', 'description' => 'Gestion du portefeuille'],
    ]);
}

}
