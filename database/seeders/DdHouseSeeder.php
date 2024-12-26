<?php

namespace Database\Seeders;

use App\Models\DdHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DdHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DdHouse::insert([
            ['code' => 'MYMVAI01', 'name' => 'Patwary Telecom', 'cluster' => 'East', 'region' => 'Brahmanbaria', 'status' => 1],
            ['code' => 'MYMVAI02', 'name' => 'Modina Store', 'cluster' => 'North East', 'region' => 'Mymensingh', 'status' => 1],
            ['code' => 'MYMVAI03', 'name' => 'Sumaya Enterprise', 'cluster' => 'East', 'region' => 'Brahmanbaria', 'status' => 1],
        ]);
    }
}
