<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'type' => 'Admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01821916104',
            'password' => md5('abc123'),
            'status' => 'Active',
        ]);
    }
}
