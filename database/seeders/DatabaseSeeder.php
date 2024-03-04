<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Faker\Provider\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create superadmin account
        User::create([
            'firstname' => 'Super Admin',
            'lastname' => 'Super Admin',
            'superadmin' => true,
            'email' => 'eminibest@gmail.com',
            'password' => bcrypt('admin001'),
            'is_la' => false,
        ]);
    }
}
