<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->admin()
            ->state([
                'name' => 'Admin',
                'email' => 'admin@example.com',
            ])
            ->create();

        User::factory()
            ->state([
                'name' => 'User',
                'email' => 'user@example.com',
            ])
            ->create();
    }
}
