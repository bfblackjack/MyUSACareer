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
        Schema::create('outgoing_ads_queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outgoing_ad_id')->references('id')->on('outgoing_ads');
            $table->string('query');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_ads_queries');
    }
};
