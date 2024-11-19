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
        Schema::create('toons', function (Blueprint $table) {
            $table->unsignedInteger('chid')->unique();
            $table->primary('chid');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'id'
            );
            $table->timestamps();
            $table->string('access_token', 5000);
            $table->string('refresh_token', 3000);
            $table->integer('corporation_id');
            $table->integer('alliance_id');
            $table->string('character_name');
            $table->integer('expires');
            $table->dateTime('last_fetch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toons');
    }
};
