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
                'name' => 'admin',
                'email' => 'admin@blog-bridge.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::ADMIN
            ],
            [
                'name' => 'user1',
                'email' => 'user1@blog-bridge.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::USER
            ],
            [
                'name' => 'user2',
                'email' => 'user2@blog-bridge.com',
                'password' => bcrypt('12345678'),
                'is_admin' => UserType::USER
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
