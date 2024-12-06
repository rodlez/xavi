<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected  $table = 'pf_tags';
    protected  $tableTranslation = 'pf_tags_trans';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pf_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('pf_tags_trans', function (Blueprint $tableTranslation) {
            $tableTranslation->id();

            $tableTranslation->unsignedBigInteger('pf_tag_id');
            $tableTranslation->unsignedBigInteger('lang_id');

            $tableTranslation->string('name');

            $tableTranslation->foreign('pf_tag_id')->references('id')->on('pf_tags')->onDelete('cascade');
            $tableTranslation->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $tableTranslation->unique(['pf_tag_id', 'lang_id']);

            $tableTranslation->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_tags_trans');
        Schema::dropIfExists('pf_tags');
    }
};
