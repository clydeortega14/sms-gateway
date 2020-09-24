<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credentials', function (Blueprint $table) {
            //Drop Unused Columns
            $table->dropColumn('status');

            $table->unsignedInteger('client_id')->nullable()->after('user_id');
            $table->string('short_code')->nullable()->after('client_id');
            $table->string('app_name')->nullable()->after('access_token');
            $table->boolean('active')->default(false)->after('subscription');

            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credentials', function (Blueprint $table) {
            $table->dropForeign('credentials_client_id_foreign');
            $table->dropColumn(['client_id', 'short_code', 'app_name']);
        });
    }
}
