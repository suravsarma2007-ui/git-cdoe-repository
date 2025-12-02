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
        Schema::create('paper_allocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paper_id');
            $table->unsignedBigInteger('emp_id');
            $table->string('module_no')->nullable();
            $table->unsignedTinyInteger('semester')->nullable();
            $table->year('year');
            $table->unsignedTinyInteger('week_no')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');
            $table->foreign('emp_id')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paper_allocations');
    }
};
