<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('student_id');
            $table->enum('status', ['enrolled', 'dropped', 'completed'])->default('enrolled');
            $table->date('enrollment_date');
            $table->date('completion_date')->nullable();
            $table->decimal('grade', 5, 2)->nullable();
            $table->string('grade_letter', 2)->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('student_records')->onDelete('cascade');
            $table->unique(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_enrollments');
    }
}
