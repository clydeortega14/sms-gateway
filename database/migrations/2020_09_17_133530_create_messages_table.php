<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('credential_id');
            $table->unsignedInteger('branch_id');
            $table->string('mobile_number');
            $table->text('message');
            $table->unsignedSmallInteger('status');
            $table->timestamps();


            $table->foreign('credential_id')->references('id')->on('credentials')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('branch_id')->references('id')->on('branches')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('status')->references('id')->on('message_statuses')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
