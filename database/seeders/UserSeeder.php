<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserType;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin2',
                'email' => 'admi2@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::ADMIN
            ],
            [
                'name' => 'user10',
                'email' => 'user10@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::USER
            ],
            [
                'name' => 'user20',
                'email' => 'user20@gmail.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::USER
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
