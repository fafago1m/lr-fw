<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\UserSeeder as SeedersUserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(SeedersUserSeeder::class);
    }
}
