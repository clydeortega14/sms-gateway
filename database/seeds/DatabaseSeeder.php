<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InformationsSeeder::class,
        	UserSeeder::class,
        	RolesSeeder::class,
        	RoleUserSeeder::class,
            StatusSeeder::class,
            SubscriptionTypeSeeder::class,
            TelcomSeeder::class,
        ]);
    }
}
