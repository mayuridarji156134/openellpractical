<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHistoryidToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_files', function (Blueprint $table) {
            $table->unsignedBigInteger('history_id')->nullable()->after('created_by');
            $table->foreign('history_id')->references('id')->on('project_history')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_files', function (Blueprint $table) {
            $table->dropColumn('history_id');
        });
    }
}
