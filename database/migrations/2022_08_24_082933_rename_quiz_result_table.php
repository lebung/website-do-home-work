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
        Schema::table('quiz_result', function (Blueprint $table) {
            //
        });

        Schema::table('quiz_result', function (Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['quiz_id']);
        });

        Schema::rename('quiz_result','quiz_results');

        Schema::table('quiz_results', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('quiz_results','quiz_result');
    }
};
