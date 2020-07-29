<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'superadmin', 'display_name'=>'Super Admin', 'description'=>'Has All Access of Admin Modules']);
        Role::create(['name'=>'admin', 'display_name'=>'Admin', 'description'=>'Has Access of Admin Modules']);
    	Role::create(['name'=>'head_office', 'display_name'=>'Head Office', 'description'=>'Has Access Adding Branch Credentials Modules']);
    	Role::create(['name'=>'branch', 'display_name'=>'Branch', 'description'=>'Has Acces to View Details']);
    }
}
