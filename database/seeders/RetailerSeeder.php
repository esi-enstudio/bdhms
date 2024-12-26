<?php

namespace Database\Seeders;

use App\Models\Retailer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RetailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Retailer::insert([
            ['dd_house_id' => 1, 'user_id' => 16, 'rso_id' => 1, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028801', 'name' => 'Store 1', 'number' => '01967022201', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 17, 'rso_id' => 1, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028802', 'name' => 'Store 2', 'number' => '01967022202', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 18, 'rso_id' => 1, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028803', 'name' => 'Store 3', 'number' => '01967022203', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 19, 'rso_id' => 2, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028804', 'name' => 'Store 4', 'number' => '01967022204', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 20, 'rso_id' => 2, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028805', 'name' => 'Store 5', 'number' => '01967022205', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 21, 'rso_id' => 2, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028806', 'name' => 'Store 6', 'number' => '01967022206', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 22, 'rso_id' => 3, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028807', 'name' => 'Store 7', 'number' => '01967022207', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 23, 'rso_id' => 3, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028808', 'name' => 'Store 8', 'number' => '01967022208', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 1, 'user_id' => 24, 'rso_id' => 3, 'zm' => 1, 'manager' => 3, 'supervisor' => 4, 'code' => 'R028809', 'name' => 'Store 9', 'number' => '01967022209', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 25, 'rso_id' => 4, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028810', 'name' => 'Store 10', 'number' => '01967022210', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 26, 'rso_id' => 4, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028811', 'name' => 'Store 11', 'number' => '01967022211', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 27, 'rso_id' => 4, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028812', 'name' => 'Store 12', 'number' => '01967022212', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 28, 'rso_id' => 5, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028813', 'name' => 'Store 13', 'number' => '01967022213', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 29, 'rso_id' => 5, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028814', 'name' => 'Store 14', 'number' => '01967022214', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 30, 'rso_id' => 5, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028815', 'name' => 'Store 15', 'number' => '01967022215', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 31, 'rso_id' => 6, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028816', 'name' => 'Store 16', 'number' => '01967022216', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 32, 'rso_id' => 6, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028817', 'name' => 'Store 17', 'number' => '01967022217', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 2, 'user_id' => 33, 'rso_id' => 6, 'zm' => 2, 'manager' => 3, 'supervisor' => 5, 'code' => 'R028818', 'name' => 'Store 18', 'number' => '01967022218', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 34, 'rso_id' => 7, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028819', 'name' => 'Store 19', 'number' => '01967022219', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 35, 'rso_id' => 7, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028820', 'name' => 'Store 20', 'number' => '01967022220', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 36, 'rso_id' => 7, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028821', 'name' => 'Store 21', 'number' => '01967022221', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 37, 'rso_id' => 8, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028822', 'name' => 'Store 22', 'number' => '01967022222', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 38, 'rso_id' => 8, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028823', 'name' => 'Store 23', 'number' => '01967022223', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 39, 'rso_id' => 8, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028824', 'name' => 'Store 24', 'number' => '01967022224', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 40, 'rso_id' => 9, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028825', 'name' => 'Store 25', 'number' => '01967022225', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 41, 'rso_id' => 9, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028826', 'name' => 'Store 26', 'number' => '01967022226', 'created_at' => now(), 'updated_at' => now()],
            ['dd_house_id' => 3, 'user_id' => 42, 'rso_id' => 9, 'zm' => 1, 'manager' => 3, 'supervisor' => 6, 'code' => 'R028827', 'name' => 'Store 27', 'number' => '01967022227', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
