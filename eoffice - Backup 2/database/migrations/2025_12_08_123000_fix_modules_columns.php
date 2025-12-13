<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Add correctly spelled columns if they don't exist
        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'moduleno')) {
                $table->unsignedInteger('moduleno')->nullable()->after('module_id');
            }
            if (!Schema::hasColumn('modules', 'target_date')) {
                $table->date('target_date')->nullable()->after('create_date');
            }
        });

        // Backfill data from misspelled columns if they exist
        if (Schema::hasColumn('modules', 'moduelno')) {
            DB::statement('UPDATE modules SET moduleno = moduelno WHERE moduleno IS NULL');
        }
        if (Schema::hasColumn('modules', 'traget_date')) {
            DB::statement('UPDATE modules SET target_date = traget_date WHERE target_date IS NULL');
        }

        // Drop old misspelled columns if they exist
        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'moduelno')) {
                $table->dropColumn('moduelno');
            }
            if (Schema::hasColumn('modules', 'traget_date')) {
                $table->dropColumn('traget_date');
            }
        });
    }

    public function down(): void
    {
        // Recreate old columns (nullable) and move data back, then drop new ones
        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'moduelno')) {
                $table->unsignedInteger('moduelno')->nullable()->after('module_id');
            }
            if (!Schema::hasColumn('modules', 'traget_date')) {
                $table->date('traget_date')->nullable()->after('create_date');
            }
        });

        if (Schema::hasColumn('modules', 'moduleno')) {
            DB::statement('UPDATE modules SET moduelno = moduleno WHERE moduelno IS NULL');
        }
        if (Schema::hasColumn('modules', 'target_date')) {
            DB::statement('UPDATE modules SET traget_date = target_date WHERE traget_date IS NULL');
        }

        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'moduleno')) {
                $table->dropColumn('moduleno');
            }
            if (Schema::hasColumn('modules', 'target_date')) {
                $table->dropColumn('target_date');
            }
        });
    }
};
