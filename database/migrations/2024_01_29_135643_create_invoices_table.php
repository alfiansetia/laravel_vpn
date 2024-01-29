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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('vpn_id')->nullable();
            $table->dateTime('date')->useCurrent();
            $table->string('number');
            $table->integer('price')->default(0);
            $table->integer('total')->default(0);
            $table->integer('amount')->default(0);
            $table->enum('status', ['paid', 'unpaid', 'cancel'])->default('unpaid');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('bank_id')->references('id')->on('banks')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('vpn_id')->references('id')->on('vpns')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
