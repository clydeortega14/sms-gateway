   <?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Status::create(['name'=>'Active', 'class'=>'label label-success']);
    	Status::create(['name'=>'Inactive', 'class'=>'label label-danger']);
    }
}
