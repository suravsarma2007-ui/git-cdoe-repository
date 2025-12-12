<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('target_table', function (Blueprint $table) {
            $table->unique(['paper_id','module_id','week_id','from_date'], 'target_unique_combo');
        });
    }

    public function down(): void
    {
        Schema::table('target_table', function (Blueprint $table) {
            $table->dropUnique('target_unique_combo');
        });
    }
};
