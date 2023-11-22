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
        Schema::table('user_class', function (Blueprint $table) {
            $table->dropForeign(['class_id']);

            $table->renameColumn('class_id','classroom_id');

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
        Schema::table('user_class', function (Blueprint $table) {
            $table->renameColumn('classroom_id','class_id');
        });
    }
};
