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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ip');
            $table->string('domain');
            $table->string('netwatch');
            $table->string('username')->default('admin');
            $table->string('password')->default('$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
            $table->string('location')->nullable();
            $table->string('sufiks')->nullable();
            $table->integer('port')->default(0);
            $table->integer('price')->default(0);
            $table->integer('annual_price')->default(0);
            $table->string('last_ip');
            // $table->integer('count_ip')->default(0);
            // $table->integer('last_port')->default(0);
            $table->enum('is_active', ['yes', 'no'])->default('yes');
            $table->enum('is_available', ['yes', 'no'])->default('yes');
            // $table->integer('time_free')->default(0);
            // $table->enum('type', ['free', 'paid'])->default('paid');
            // $table->enum('api', ['active', 'nonactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
