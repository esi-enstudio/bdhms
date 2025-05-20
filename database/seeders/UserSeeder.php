<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1: Create roles
        $roles = [
            'super_admin',
            'manager',
            'supervisor',
            'rso',
            'bp',
            'accountant',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Step 2: Define users
        $users = [
            ['Emil Sadekin Islam', '01732547755', 'sadekinislam6@gmail.com', '3213'],
            ['MD. ALI HOSSAIN', '1711000001', 'rso01@gmail.com', 'password'],
            ['Safiqul Islam', '1711000002', 'rso02@gmail.com', 'password'],
            ['Saddam', '1711000003', 'rso03@gmail.com', 'password'],
            ['Badiuzzaman', '1711000004', 'rso04@gmail.com', 'password'],
            ['Md. Golam Mostufa', '1711000005', 'rso05@gmail.com', 'password'],
            ['RIPON RANA', '1711000006', 'rso06@gmail.com', 'password'],
            ['MD. RASEL MIA', '1711000007', 'rso07@gmail.com', 'password'],
            ['Robin Mia', '1711000008', 'rso08@gmail.com', 'password'],
            ['Md. Thouhul Amin', '1711000009', 'rso09@gmail.com', 'password'],
            ['MD POROSH MIAH', '1711000010', 'rso10@gmail.com', 'password'],
            ['MD. Hasan Mia', '1711000011', 'rso11@gmail.com', 'password'],
            ['ABUL BASHER RANA', '1711000012', 'rso12@gmail.com', 'password'],
            ['MAHMUD HASAN EMON', '1711000013', 'rso13@gmail.com', 'password'],
            ['MD MIJANUR RAHMAN', '1711000014', 'rso14@gmail.com', 'password'],
            ['Hridoy Mia', '1711000015', 'rso15@gmail.com', 'password'],
            ['Md. Hridoy Mia', '1711000016', 'rso16@gmail.com', 'password'],
            ['SAHADAT HOSSAIN', '1711000017', 'rso17@gmail.com', 'password'],
            ['Mijan', '1711000018', 'rso18@gmail.com', 'password'],
            ['Hossain Bhuyan', '1711000019', 'rso19@gmail.com', 'password'],
            ['Md. Mamun Mia', '1711000020', 'rso20@gmail.com', 'password'],
            ['RIAZ AHMED', '1711000021', 'rso21@gmail.com', 'password'],
            ['FERDOUS MIA', '1711000022', 'rso22@gmail.com', 'password'],
            ['MD MOKHTAKIN', '1711000023', 'rso23@gmail.com', 'password'],
            ['Md. Shahin mia', '1711000024', 'rso24@gmail.com', 'password'],
            ['Opi Ahmed Shuvo', '1711000025', 'rso25@gmail.com', 'password'],
            ['Titu Mia', '1923909896', 'supervisor01@gmail.com', 'password'],
            ['Ruhul Amin', '1911266077', 'supervisor02@gmail.com', 'password'],
            ['Mobashir Ahmed', '1923909897', 'supervisor03@gmail.com', 'password'],
        ];

        // Step 3: Create users and assign roles
        foreach ($users as [$name, $phone, $email, $password]) {
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'slug' => Str::random(10),
                    'avatar' => null,
                    'name' => $name,
                    'phone_number' => $phone,
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                    'status' => 'active',
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Role assignment logic
            if ($email === 'sadekinislam6@gmail.com') {
                $user->assignRole('super_admin');
            } elseif (str_starts_with($email, 'rso')) {
                $user->assignRole('rso');
            } elseif (str_starts_with($email, 'supervisor')) {
                $user->assignRole('supervisor');
            } else {
                // Optionally assign a default role like 'manager' or leave empty
                $user->assignRole('manager');
            }
        }

        // Attach all houses to the super admin user
//        $superAdmin = User::where('email', 'sadekinislam6@gmail.com')->first();
//
//        if ($superAdmin) {
//            $houses = House::where('status', 'active')->get();
//
//            // Adjust depending on your actual relationship: belongsToMany or hasMany
//            $superAdmin->houses()->syncWithoutDetaching($houses->pluck('id'));
//        }
    }
}
