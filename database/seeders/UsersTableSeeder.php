<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'email' => 'as254351@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            // 'dni' => '123548489',
            'role' => 'admin',
            // 'phone' => '064848454',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
