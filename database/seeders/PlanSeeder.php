<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Free Plan', 
                'slug' => 'free-plan', 
                'stripe_plan' => 'price_1MZJZGCSkADIfETSEpthV6Gv', 
                'price' => 0, 
                'description' => 'This is a free membership plan. Free members will be able to create 2 posts daily.'
            ],
            [
                'name' => 'Premium Plan', 
                'slug' => 'premium-plan', 
                'stripe_plan' => 'price_1MaGu0CSkADIfETSB9gwJsNy', 
                'price' => 10, 
                'description' => 'This is premium membership plan. Premium members will be able to create unlimited posts.'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
