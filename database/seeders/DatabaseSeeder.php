<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'phone_number' => '09489203090',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone_number' => '00000000000',
            'password' => bcrypt('password'),
            'account_type' => 'admin',
        ]);
    }
}
