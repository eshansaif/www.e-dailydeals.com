<?php

use Illuminate\Database\Seeder;

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
            'type' => 'Admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01821916104',
            'password' => bcrypt('abc123'),
        ]);
    }
}
