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
        Schema::create('vpns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('server_id');
            $table->string('ip');
            $table->string('username');
            $table->string('password');
            // $table->date('regist');
            $table->dateTime('last_renew')->useCurrent();
            $table->date('expired');
            $table->enum('is_active', ['yes', 'no'])->default('yes');
            $table->enum('is_trial', ['yes', 'no'])->default('yes');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('server_id')->references('id')->on('servers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vpns');
    }
};
