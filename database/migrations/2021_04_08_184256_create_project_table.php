<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('title')->index();
           $table->text('description')->nullable();
           $table->date('due_date')->nullable()->index();
           $table->unsignedBigInteger('assign_to')->nullable();
           $table->unsignedBigInteger('created_by')->nullable();
           $table->unsignedBigInteger('last_modified_by')->nullable();
           $table->timestamps();
           $table->softDeletes();
           $table->foreign('assign_to')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('project');
    }
}
