<?php

namespace Database\Seeders;

use App\Models\DdHouse;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(280)->create();
//         DdHouse::factory(3)->create();
//         Rso::factory(25)->create();
//         Retailer::factory(250)->create();

        $this->call(DdHouseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RsoSeeder::class);
        $this->call(RetailerSeeder::class);
        $this->call(ProductSeeder::class);


        User::factory()->create([
            'name' => 'Emil Sadekin Islam',
            'email' => 'nilemil007@gmail.com',
            'phone' => '01732547755',
            'role' => 'admin',
            'status' => 1,
            'password' => Hash::make('32133213'),
        ]);
    }
}
