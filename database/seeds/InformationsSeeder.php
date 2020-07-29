<?php

use Illuminate\Database\Seeder;
use App\Informations;

class InformationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Informations::create(['company' => 'Coredev Solutions Inc.', 'address' => '96 J. Alcantara', 'zip_code' => 'Philippines 6000']);
        Informations::create(['company' => 'Coredev Solutions Inc.', 'address' => '96 J. Alcantara', 'zip_code' => 'Philippines 6000']);
    }
}
