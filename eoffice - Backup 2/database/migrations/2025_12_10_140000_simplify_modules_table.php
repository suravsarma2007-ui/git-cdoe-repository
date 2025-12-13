<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            // Rename primary key id -> slno if exists
            if (Schema::hasColumn('modules', 'id')) {
                $table->renameColumn('id', 'slno');
            }
            // Rename moduleno -> moduleNo if exists; else create moduleNo
            if (Schema::hasColumn('modules', 'moduleno')) {
                $table->renameColumn('moduleno', 'moduleNo');
            } else if (!Schema::hasColumn('modules', 'moduleNo')) {
                $table->integer('moduleNo')->nullable();
            }
        });

        // Drop all other columns
        Schema::table('modules', function (Blueprint $table) {
            $dropCols = ['module_id','dd','mm','yy','week_no','semester','create_date','target_date','traget_date','deleted_at','created_at','updated_at'];
            foreach ($dropCols as $col) {
                if (Schema::hasColumn('modules', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    public function down(): void
    {
        // Note: Irreversible simplification. We will recreate minimal previous columns if needed.
        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'slno')) {
                $table->renameColumn('slno', 'id');
            }
            if (Schema::hasColumn('modules', 'moduleNo')) {
                $table->renameColumn('moduleNo', 'moduleno');
            }
            // We won't restore other columns in down.
        });
    }
};
