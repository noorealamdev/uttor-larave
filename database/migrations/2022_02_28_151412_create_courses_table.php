<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('teacher_id');
            $table->integer('sale_price');
            $table->integer('regular_price')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();
            $table->string('course_duration')->nullable();
            $table->text('video_preview')->nullable();
            $table->text('thumbnail')->nullable();
            $table->integer('students_count')->nullable();
            $table->text('instructions')->nullable();
            $table->text('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
