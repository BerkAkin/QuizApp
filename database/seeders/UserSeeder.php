<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' => 'Berk Akın',
            'email' => 'berkakinadmin@hotmail.com',
            'email_verified_at' => now(),
            'type' => 'ustYonetici',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::insert([
            'name' => 'Berk Akın',
            'email' => 'berkakinogretmen@hotmail.com',
            'email_verified_at' => now(),
            'type' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::insert([
            'name' => 'Berk Akın',
            'email' => 'berkakin@hotmail.com',
            'email_verified_at' => now(),
            'type' => 'user',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(10)->create();
    }
}