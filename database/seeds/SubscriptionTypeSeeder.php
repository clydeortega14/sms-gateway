<?php

use App\SubscriptionType;
use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionType::create(['name'=>'Prepaid', 'class'=>'label label-primary']);
        SubscriptionType::create(['name'=>'Postpaid', 'class'=>'label label-warning']);
    }
}
