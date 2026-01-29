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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('name');
            $table->string('designation');
            $table->enum('staff_type', ['Faculty', 'Non-Teaching', 'Support']);
            $table->string('discipline')->nullable();
            $table->string('subject')->nullable();
            $table->string('official_email')->unique()->nullable();
            $table->string('personal_email')->nullable();
            $table->string('contact', 20)->nullable();
            $table->date('doj'); // Date of Joining
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
