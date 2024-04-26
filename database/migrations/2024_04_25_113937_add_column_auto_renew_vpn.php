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
        Schema::table('vpns', function (Blueprint $table) {
            $table->enum('auto_renew', ['yes', 'no'])->default('no')->after('is_trial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vpns', function (Blueprint $table) {
            $table->dropColumn('auto_renew');
        });
    }
};
