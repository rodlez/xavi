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
        Schema::create('portfolio_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained('portfolios')->onDelete('cascade');
            $table->string('original_filename', length: 200);
            $table->string('storage_filename', length: 100);
            $table->string('path', length: 4096);
            $table->string('media_type', length: 200);  // 0 to 4294967295 store up to (4.29Gb)
            $table->unsignedInteger('size');
            $table->timestamps();
        });

        Schema::table('portfolio_files', function (Blueprint $table) {
            $table->index('portfolio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_files');
    }
};
