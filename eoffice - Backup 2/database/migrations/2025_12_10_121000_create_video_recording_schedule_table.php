<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_recording_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('paper_id');
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('week_id');
            $table->date('record_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('status', 50)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_recording_schedule');
    }
};
