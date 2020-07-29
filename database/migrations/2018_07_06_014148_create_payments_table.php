<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credentials_id');
            $table->decimal('amount', 8, 2);
            $table->dateTime('date_start')->nullable()->index();
            $table->dateTime('date_expire')->nullable()->index();
            $table->longText('description');
            $table->unsignedInteger('status');
            $table->unsignedInteger('email_status')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
