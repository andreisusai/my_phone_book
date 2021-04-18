<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user',
            'role' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make("user"), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make("admin"), // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'gestionnaire',
            'role' => 'gestionnaire',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make("gestionnaire"), // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\Company::factory(10)->create();
        // \App\Models\Contributor::factory(10)->create();
    }
}
