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
        Schema::create('portfolios_trans_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pf_id')->constrained('portfolios_translation')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('pf_tags_trans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios_trans_tags');
    }
};
