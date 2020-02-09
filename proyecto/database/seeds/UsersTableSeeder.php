<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
	Model::unguard();
	$this->call(UserTableSeeder::class);
	Model::reguard();
    }
}
