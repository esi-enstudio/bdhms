<?php

namespace Database\Seeders;

use App\Models\Rso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rso::insert([
            ['dd_house_id' => 1, 'user_id' => 7, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'RS040001', 'number' => '01915270101', 'status' => 1],
            ['dd_house_id' => 1, 'user_id' => 8, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'RS040002', 'number' => '01915270102', 'status' => 1],
            ['dd_house_id' => 1, 'user_id' => 9, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'RS040003', 'number' => '01915270103', 'status' => 1],
            ['dd_house_id' => 2, 'user_id' => 10, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'RS040004', 'number' => '01915270104', 'status' => 1],
            ['dd_house_id' => 2, 'user_id' => 11, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'RS040005', 'number' => '01915270105', 'status' => 1],
            ['dd_house_id' => 2, 'user_id' => 12, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'RS040006', 'number' => '01915270106', 'status' => 1],
            ['dd_house_id' => 3, 'user_id' => 13, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'RS040007', 'number' => '01915270107', 'status' => 1],
            ['dd_house_id' => 3, 'user_id' => 14, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'RS040008', 'number' => '01915270108', 'status' => 1],
            ['dd_house_id' => 3, 'user_id' => 15, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'RS040009', 'number' => '01915270109', 'status' => 1],
        ]);
    }
}
