<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('course_chapter_lessions', function (Blueprint $table) {
            $table->dropForeign(['course_id']);

            $table->foreign('course_id')
                  ->references('id')->on('courses')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('course_chapter_lessions', function (Blueprint $table) {
            $table->dropForeign(['course_id']);

            $table->foreign('course_id')
                  ->references('id')->on('courses');
        });
    }
};
