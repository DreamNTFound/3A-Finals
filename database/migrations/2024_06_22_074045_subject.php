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
        Schema::create('subjects', function (Blueprint $table){
            $table->id();
            $table->integer('student_id');
            $table->string('subject_code');
            $table->string('name');
            $table->string('description');
            $table->string('instructor');
            $table->string('schedule');
            $table->json('grades')->nullable();
            $table->double('prelims');
            $table->double('midterms');
            $table->double('prefinals');
            $table->double('finals');
            $table->double('average_grade')->nullable();
            $table->string('remarks')->nullable();
            $table->date('date_taken');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
