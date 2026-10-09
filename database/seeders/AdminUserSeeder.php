<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'username' => 'Munna',
            'password' => Hash::make('Munna_68662'),
            'role' => 'admin',
            'active' => 1,
            'must_change_password' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}