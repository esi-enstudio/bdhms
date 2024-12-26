<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Zm', 'phone' => '01911000001', 'email' => 'zm@gmail.com', 'role' => 'zm', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Mdo', 'phone' => '01911000002', 'email' => 'mdo@gmail.com', 'role' => 'mdo', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Manager', 'phone' => '01911000003', 'email' => 'manager@gmail.com', 'role' => 'manager', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Supervisor 1', 'phone' => '01911000004', 'email' => 'supervisor1@gmail.com', 'role' => 'supervisor', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor 2', 'phone' => '01911000005', 'email' => 'supervisor2@gmail.com', 'role' => 'supervisor', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor 3', 'phone' => '01911000006', 'email' => 'supervisor3@gmail.com', 'role' => 'supervisor', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Rso 1', 'phone' => '01911000007', 'email' => 'rso1@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 2', 'phone' => '01911000008', 'email' => 'rso2@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 3', 'phone' => '01911000009', 'email' => 'rso3@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 4', 'phone' => '01911000010', 'email' => 'rso4@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 5', 'phone' => '01911000011', 'email' => 'rso5@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 6', 'phone' => '01911000012', 'email' => 'rso6@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 7', 'phone' => '01911000013', 'email' => 'rso7@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 8', 'phone' => '01911000014', 'email' => 'rso8@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rso 9', 'phone' => '01911000015', 'email' => 'rso9@gmail.com', 'role' => 'rso', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Retailer 1', 'phone' => '01911000016', 'email' => 'retailer1@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 2', 'phone' => '01911000017', 'email' => 'retailer2@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 3', 'phone' => '01911000018', 'email' => 'retailer3@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 4', 'phone' => '01911000019', 'email' => 'retailer4@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 5', 'phone' => '01911000020', 'email' => 'retailer5@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 6', 'phone' => '01911000021', 'email' => 'retailer6@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 7', 'phone' => '01911000022', 'email' => 'retailer7@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 8', 'phone' => '01911000023', 'email' => 'retailer8@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 9', 'phone' => '01911000024', 'email' => 'retailer9@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 10', 'phone' => '01911000025', 'email' => 'retailer10@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 11', 'phone' => '01911000026', 'email' => 'retailer11@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 12', 'phone' => '01911000027', 'email' => 'retailer12@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 13', 'phone' => '01911000028', 'email' => 'retailer13@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 14', 'phone' => '01911000029', 'email' => 'retailer14@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 15', 'phone' => '01911000030', 'email' => 'retailer15@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 16', 'phone' => '01911000031', 'email' => 'retailer16@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 17', 'phone' => '01911000032', 'email' => 'retailer17@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 18', 'phone' => '01911000033', 'email' => 'retailer18@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 19', 'phone' => '01911000034', 'email' => 'retailer19@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 20', 'phone' => '01911000035', 'email' => 'retailer20@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 21', 'phone' => '01911000036', 'email' => 'retailer21@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 22', 'phone' => '01911000037', 'email' => 'retailer22@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 23', 'phone' => '01911000038', 'email' => 'retailer23@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 24', 'phone' => '01911000039', 'email' => 'retailer24@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 25', 'phone' => '01911000040', 'email' => 'retailer25@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 26', 'phone' => '01911000041', 'email' => 'retailer26@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Retailer 27', 'phone' => '01911000042', 'email' => 'retailer27@gmail.com', 'role' => 'retailer', 'status' => 1, 'password' => Hash::make('password'), 'remember_token' => Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
