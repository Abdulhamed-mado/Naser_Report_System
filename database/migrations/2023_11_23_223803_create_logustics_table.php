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
        Schema::create('logustics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('team');
            $table->date('order_date');
            $table->unsignedTinyInteger('order_month');
            $table->string('note');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logustics');
    }
};
