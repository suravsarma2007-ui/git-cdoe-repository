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
        //
            Schema::create('daily_record_video_table', function (Blueprint $table) {
                $table->id(); // Primary Key                
                $table->string('program_id')->nullable(); // Program ID
                $table->string('module_id')->nullable(); // Module ID
                $table->string('paper_id')->nullable(); // Paper ID
                $table->string('video_no')->nullable(); // Video Number
                $table->string('emp_id')->nullable(); // Employee ID
                $table->string('recording_status')->nullable(); // Employee Name
                $table->date('record_date')->nullable(); // Date of the record of video
                $table->string('editing_status')->nullable(); // Editing Status 
                $table->string('editor_emp_id')->nullable(); // Editor Employee ID
                $table->string('ppt_status')->nullable(); // PPT Status
                $table->date('ppt_submittion_date')->nullable(); // PPT Submission date by Faculty
                $table->string('eslm_status')->nullable(); // ESLM Status
                $table->date('eslm_submittion_date')->nullable(); // ESLM Submission date by Faculty
                $table->string('eslm_web_uploaded_status')->nullable(); // ESLM Website Uploaded Status
                $table->string('eslm_web_uploaded_date')->nullable(); // ESLM Website Uploaded Date
                $table->timestamps(); // Timestamps for created_at and updated_at                
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('daily_record_video_table');


    }
};
