<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppt', function (Blueprint $table) {
            $table->id(); // Sl. No
            $table->string('paper', 100);
            $table->string('emp_id', 50);
            $table->string('program_id', 50);
            $table->unsignedTinyInteger('module_no');
            $table->string('status', 50)->nullable();
            $table->unsignedInteger('no_of_ppt')->nullable();
            $table->string('screen_recording', 100)->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedInteger('total')->nullable();
            $table->date('date_of_submit');
            $table->string('ppt_file_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppt');
    }
};
