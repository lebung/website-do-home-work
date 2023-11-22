<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_class', function (Blueprint $table){
           $table->dropForeign(['classroom_id']);
        });

        Schema::rename('user_class','user_classroom');

        Schema::table('user_classroom', function (Blueprint $table){
           $table->foreign('classroom_id')->references('id')->on('classrooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('user_classroom','user_class');
    }
};
