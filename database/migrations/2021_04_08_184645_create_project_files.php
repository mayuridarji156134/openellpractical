<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_files', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('name')->index();
           $table->unsignedBigInteger('project_id')->nullable();
           $table->unsignedBigInteger('created_by')->nullable();
           $table->unsignedBigInteger('last_modified_by')->nullable();
           $table->timestamps();
           $table->softDeletes();
           $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('last_modified_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_files');
    }
}
