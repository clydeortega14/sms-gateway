<?php

use App\User;
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
        User::create(['information_id' => 1,'status_id' => 1,'username'=>'superadmin', 'name'=>'superadmin', 'email'=>'superadmin@coredev.ph', 'password'=>Hash::make('superadmin')]);
        User::create(['information_id' => 2,'status_id' => 1,'username'=>'admin', 'name'=>'admin', 'email'=>'admin@coredev.ph', 'password'=>Hash::make('password')]);


    }
}
