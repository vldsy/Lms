<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 2 users
        //User::truncate();
        User::where('id', '>', 0)->delete();

        $password = "12345";

        User::create([
            'name' => "John Doe",
            'email' => "johndoe@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt($password),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => "Bill Gates",
            'email' => "billgates@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt($password),
            'remember_token' => Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(7)->create();
    }
}
