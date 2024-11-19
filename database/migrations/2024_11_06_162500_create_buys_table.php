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
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'buy_u_id'
            );
            $table->string('name', 3000);
            $table->integer('region');
            $table->integer('type');
            $table->integer('length');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('discord', 30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buys');
    }
};
