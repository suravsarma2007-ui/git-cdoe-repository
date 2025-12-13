<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('modules') && !Schema::hasColumn('modules', 'deleted_at')) {
            Schema::table('modules', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('modules') && Schema::hasColumn('modules', 'deleted_at')) {
            Schema::table('modules', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
