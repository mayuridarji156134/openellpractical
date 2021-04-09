<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Add mentioned fields into the DB
        Schema::table('users', function (Blueprint $table) {
           $table->string('social_id')->nullable()->after('password');
           $table->string('dialcode_phoneno')->nullable()->after('social_id');
           $table->string('profile')->nullable()->after('dialcode_phoneno');
           $table->enum('user_type', ['client', 'designer'])->nullable()->after('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop columns from users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('social_id');
            $table->dropColumn('dialcode_phoneno');
            $table->dropColumn('profile');
            $table->dropColumn('user_type');
        });

       
    }
}
