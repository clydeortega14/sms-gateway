<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendMessageLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_message_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('credential_id')->nullable();
            $table->unsignedInteger('log_type_id');
            $table->text('log_message');
            $table->string('recipient_number')->nullable();
            $table->string('status_code')->nullable();
            $table->text('access_token')->nullable();
            $table->string('short_code')->nullable();
            $table->string('branch_id')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();

            $table->foreign('credential_id')->references('id')->on('credentials');
            $table->foreign('log_type_id')->references('id')->on('log_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('send_message_logs');
    }
}
