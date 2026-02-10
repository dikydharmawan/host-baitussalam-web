<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dev',
            'email' => 'dev@mail.com',
            'role' => UserRole::SUPER_ADMIN,
            'position' => 'developer',
            'password' => 'dev123',
        ]);
        User::factory()->create([
            'name' => 'Bpk.ketua',
            'email' => 'admin@mail.com',
            'role' => UserRole::TAKMIR_ADMIN,
            'position' => 'ketua',
            'password' => 'admin123',
        ]);
        User::factory()->create([
            'name' => 'Bpk.wakil',
            'email' => 'admin1@mail.com',
            'role' => UserRole::TAKMIR_ADMIN,
            'position' => 'wakil_ketua',
            'password' => 'admin123',
        ]);
    }
}
