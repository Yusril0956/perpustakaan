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
        $this->call(RolePermissionSeeder::class);
        $this->call(CategorySeeder::class);

        \App\Models\Book::factory(50)->create();

        $admin = User::create([
            'name' => 'eserel',
            'email' => 'ryl@test.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $member = User::create([
            'name' => 'Budi Anggota',
            'email' => 'member@test.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'address' => 'Jl. Merdeka No. 10',
        ]);
        $member->assignRole('anggota');
    }
}
