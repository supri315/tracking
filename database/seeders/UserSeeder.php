<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'role_id' => 1,
            'branch_id' => 1,
            'password' => Hash::make('admin123'),
            'phone_number' => 9938377373,
        ]);
    }
}
