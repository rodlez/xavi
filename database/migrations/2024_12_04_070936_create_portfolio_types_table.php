<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected  $table = 'pf_types';
    protected  $tableTranslation = 'pf_types_trans';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pf_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('pf_types_trans', function (Blueprint $tableTranslation) {
            $tableTranslation->id();

            $tableTranslation->unsignedBigInteger('pf_type_id');
            $tableTranslation->unsignedBigInteger('lang_id');

            $tableTranslation->string('name');

            $tableTranslation->foreign('pf_type_id')->references('id')->on('pf_types')->onDelete('cascade');
            $tableTranslation->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $tableTranslation->unique(['pf_type_id', 'lang_id']);

            $tableTranslation->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_types_trans');
        Schema::dropIfExists('portfolio_types');
    }
};
