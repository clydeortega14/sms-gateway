<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            // Drop Unused Column
            $table->dropColumn(['user_id', 'credentials_id', 'branch_id']);
            // Add new columns
            $table->unsignedInteger('client_id')->nullable()->after('branch_id');
            $table->text('branch_description')->nullable()->after('branch_name');
            $table->boolean('status')->after('branch_description');


            // Foreign keys
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
        Schema::table('branches', function (Blueprint $table) {
            $table->dropForeign('branches_client_id_foreign');
            $table->dropColumn(['client_id', 'branch_description', 'status']);
        });
    }
}
