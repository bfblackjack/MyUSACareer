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
        Schema::create('partners', function(Blueprint $table) {
            $table->id();
            $table->string('partner');
            $table->tinyInteger('weight');
            $table->timestamps();
        });

        Schema::create('outgoing_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selected_partner_id')->references('id')->on('partners');
            $table->tinyInteger('pct_threshold');
            $table->string('user_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_ads');
        Schema::dropIfExists('partners');
    }
};
