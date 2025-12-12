<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('target_table', function (Blueprint $table) {
            $table->bigIncrements('slno');
            $table->unsignedBigInteger('emp_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('paper_id');
            $table->unsignedBigInteger('module_id'); // references modules.slno
            $table->unsignedBigInteger('week_id');   // references week.id
            $table->date('from_date');
            $table->date('to_date');
            $table->string('status', 20); // Pending, Completed
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->index(['emp_id']);
            $table->index(['program_id']);
            $table->index(['paper_id']);
            $table->index(['module_id']);
            $table->index(['week_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('target_table');
    }
};
