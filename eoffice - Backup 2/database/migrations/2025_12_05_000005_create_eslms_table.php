<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eslms', function (Blueprint $table) {
            $table->id(); // SlNo
            $table->string('program_id', 50);
            $table->string('paper_code', 50);
            $table->string('emp_id', 50);
            $table->unsignedTinyInteger('module_no');
            $table->string('status', 50)->nullable();
            $table->date('date_of_submit');
            $table->string('file_upload_link')->nullable();
            $table->text('remark')->nullable();
            $table->string('block', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eslms');
    }
};
