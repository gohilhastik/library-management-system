<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            $table->string('student_id',20)->unique();

            $table->string('first_name',100);

            $table->string('last_name',100);

            $table->string('email',100)->nullable();

            $table->string('phone',20)->nullable();

            $table->enum('gender',['Male','Female']);

            $table->string('course',100);

            $table->integer('semester');

            $table->text('address')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};