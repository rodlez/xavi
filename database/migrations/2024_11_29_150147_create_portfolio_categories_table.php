<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected  $table = 'pf_categories';
    protected  $tableTranslation = 'pf_categories_trans';
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('pf_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('pf_categories_trans', function (Blueprint $tableTranslation) {
            $tableTranslation->id();

            $tableTranslation->unsignedBigInteger('pf_cat_id');
            $tableTranslation->unsignedBigInteger('lang_id');

            $tableTranslation->string('name');

            $tableTranslation->foreign('pf_cat_id')->references('id')->on('pf_categories')->onDelete('cascade');
            $tableTranslation->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $tableTranslation->unique(['pf_cat_id', 'lang_id']);

            $tableTranslation->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_categories_trans');
        Schema::dropIfExists('pf_categories');
    }
};
