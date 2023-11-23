<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('pCardId');
            $table->string('name');
            $table->unsignedBigInteger('nationalNum')->unique();
            $table->string('birthDate');
            $table->string('height')->nullable();
            $table->string('speed')->nullable();
            $table->string('weight')->nullable();
            $table->string('position')->nullable();
            $table->string('strongFoot')->nullable();
            $table->string('health');
            $table->boolean('status');
            $table->string('team');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};