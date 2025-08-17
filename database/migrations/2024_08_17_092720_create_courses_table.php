<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 100);
            $table->string('code', 20)->unique();
            $table->text('description')->nullable();
            $table->integer('credit_hours')->default(3);
            $table->unsignedInteger('my_class_id');
            $table->unsignedInteger('teacher_id')->nullable();
            $table->enum('semester', ['first', 'second', 'summer'])->default('first');
            $table->string('academic_year', 20);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->foreign('my_class_id')->references('id')->on('my_classes')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');
            $table->unique(['code', 'academic_year']);
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
