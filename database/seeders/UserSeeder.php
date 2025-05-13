<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pwa.rs',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@pwa.rs',
            'password' => Hash::make('editor'),
            'role' => 'editor'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@pwa.rs',
            'password' => Hash::make('user'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Viktor',
            'email' => 'viktor@pwa.rs',
            'password' => Hash::make('viktor'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Pera',
            'email' => 'pera@pwa.rs',
            'password' => Hash::make('pera'),
            'role' => 'user'
        ]);
    }
}