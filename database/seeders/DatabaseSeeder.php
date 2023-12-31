<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // User::create([
        //     'name' => 'Test User2',
        //     'email' => 'user2@gmail.com',
        //     'phone_number' => '22222222222',
        //     'password' => bcrypt('password'),
        // ]);

        // User::create([
        //     'name' => 'Test User',
        //     'email' => 'user@gmail.com',
        //     'phone_number' => '11111111111',
        //     'password' => bcrypt('password'),
        // ]);
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone_number' => '00000000000',
            'password' => bcrypt('password'),
            'account_type' => 'admin',
        ]);


        if (!DB::table('provinces')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/address/refProvince.sql'));
        }
        if (!DB::table('cities')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/address/refCitymun.sql'));
        }
        // if (!DB::table('barangays')->count()) {
        //     DB::unprepared(file_get_contents(__DIR__ . '/address/refBrgy.sql'));
        // }
    }
}
