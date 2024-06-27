<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'leo@dev.com.br')->first()) {
            User::create([
                'name' => 'Léo',
                'email' => 'leo@dev.com.br',
                'password' => Hash::make('abc123!@#', ['rounds' => 12]),
            ]);
        }
    }
}
