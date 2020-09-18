<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sii_users')->insert([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
