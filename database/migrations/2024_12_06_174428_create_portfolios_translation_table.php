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
        Schema::create('portfolios_translation', function (Blueprint $table) {
            $table->id();
            // Foreign Keys
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('pf_cat_trans_id');
            $table->unsignedBigInteger('pf_type_trans_id');
            $table->unsignedBigInteger('lang_id');
            // Columns
            $table->string('title', length: 200);
            $table->string('subtitle', length: 200)->nullable();
            $table->text('content')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('location', length: 200)->nullable();
            $table->string('client', length: 200)->nullable();
            $table->string('project', length: 200)->nullable();
            // FK References
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            $table->foreign('pf_cat_trans_id')->references('id')->on('pf_categories_trans')->onDelete('cascade');
            $table->foreign('pf_type_trans_id')->references('id')->on('pf_types_trans')->onDelete('cascade');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            // Timestamps
            $table->timestamps();
        });

        Schema::table('portfolios_translation', function (Blueprint $table) {
            $table->index('portfolio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios_translation');
    }
};
