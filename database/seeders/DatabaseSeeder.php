<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'nickname' => 'supadmin',
            'surname' => 'sup',
            'role' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
        ]);
    }
}
