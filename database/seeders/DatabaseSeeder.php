<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $companies = Company::factory()->count(3)->create();
        $users = User::factory()->count(5)->create();

        foreach ($companies as $company) {
            Tasks::factory()
                ->count(5)
                ->for($company)
                ->for($users->random())
                ->create();
        }
    }
}
