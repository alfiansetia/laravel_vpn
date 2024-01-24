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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->dateTime('date')->useCurrent();
            $table->string('number')->unique();
            $table->bigInteger('total')->default(0);
            $table->enum('status', ['paid', 'unpaid', 'cancel'])->default('unpaid');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('bank_id')->references('id')->on('banks')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
