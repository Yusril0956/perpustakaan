<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(CategorySeeder::class);

        \App\Models\Book::factory(50)->create();

        User::create([
            'name' => 'eserel',
            'email' => 'ryl@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Anggota',
            'email' => 'member@test.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'phone' => '08123456789',
            'address' => 'Jl. Merdeka No. 10',
        ]);
    }
}
