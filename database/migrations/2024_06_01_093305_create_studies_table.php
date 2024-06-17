<?php

use App\Models\Lesson;
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
        Schema::create('study', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_lesson'); 
            $table->foreign('id_lesson')->references('id')->on('lessons')->onDelete('cascade'); 
            $table->unsignedBigInteger('modul'); 
            $table->foreign('modul')->references('id')->on('kurs')->onDelete('cascade'); 
            $table->unsignedBigInteger('status'); 
     
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study');
    }
};
