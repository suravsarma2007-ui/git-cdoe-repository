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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_id')->unique();
            $table->string('moduelno', 2);
            $table->string('dd', 2);
            $table->string('mm', 2);
            $table->string('yy', 4);
            $table->string('week_no',2);
            $table->string('semester',1);
            $table->string('create_date', 12);
            $table->string('traget_date', 12);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('modules');
    }
};
