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
        Schema::table('portfolio_files', function (Blueprint $table) {
            // Image Information Only
            $table->unsignedSmallInteger('width')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->enum('orientation', ['portrait','landscape','square'])->nullable();
            $table->unsignedSmallInteger('resolution')->nullable();
            $table->unsignedSmallInteger('position')->nullable();
            // File Information
            $table->enum('type', ['image','document']);            
            $table->string('title', length: 200)->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_files', function (Blueprint $table) {
            // Image Information Only
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('orientation');
            $table->dropColumn('resolution');
            $table->dropColumn('position');
            // File Information
            $table->dropColumn('type');            
            $table->dropColumn('title');
            $table->dropColumn('description');
        });
    }
};
