<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pf_types', function (Blueprint $table) {
            $table->after('name', function (Blueprint $table) {
                $table->unsignedSmallInteger('position')->nullable();
                $table->string('color', length: 200)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pf_types', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('color');
        });
    }
};
