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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Admin 2',
            'username' => 'admin2',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Super Admin',
            'username' => 'super_admin',
            'password' => bcrypt('123'),
            'role' => 'super_admin'
        ]);

        $this->call(UnitKerjaSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(PegawaiSeeder::class);
    }
}
