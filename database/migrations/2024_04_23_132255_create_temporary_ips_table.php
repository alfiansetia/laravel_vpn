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
        Schema::create('temporary_ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('web')->default(0);
            $table->integer('api')->default(0);
            $table->integer('win')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_ips');
    }
};
