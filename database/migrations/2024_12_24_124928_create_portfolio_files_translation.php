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
        Schema::create('portfolio_files_translation', function (Blueprint $table) {
            $table->id();
            // Foreign Keys
            $table->unsignedBigInteger('portfolio_file_id');
            $table->unsignedBigInteger('lang_id');
            // Columns
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            // FK References
            $table->foreign('portfolio_file_id')->references('id')->on('portfolio_files')->onDelete('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            // Timestamps
            $table->timestamps();
        });

        Schema::table('portfolio_files_translation', function (Blueprint $table) {
            $table->index('portfolio_file_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_files_translation');
    }
};
