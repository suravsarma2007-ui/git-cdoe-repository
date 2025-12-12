<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ppt', function (Blueprint $table) {
            $table->unsignedBigInteger('paper_id')->nullable()->after('program_id');
            // Optionally, add a foreign key constraint if you want strict integrity:
            // $table->foreign('paper_id')->references('id')->on('papers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('ppt', function (Blueprint $table) {
            $table->dropColumn('paper_id');
        });
    }
};
