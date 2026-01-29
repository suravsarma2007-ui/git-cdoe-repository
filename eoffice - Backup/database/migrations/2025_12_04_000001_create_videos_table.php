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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paper_id');
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('program_id');
            $table->string('module_no')->nullable();
            $table->unsignedTinyInteger('semester');
            $table->integer('total_videos_required')->default(0);
            $table->integer('total_videos_done')->default(0);
            $table->integer('total_videos_edited')->default(0);
            $table->integer('uploaded_videos')->default(0);
            $table->text('remark')->nullable();
            $table->date('upload_date');
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->timestamps();

            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');
            $table->foreign('emp_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
