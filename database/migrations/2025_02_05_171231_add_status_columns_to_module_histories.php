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
        Schema::table('module_histories', function (Blueprint $table) {
            $table->float('measured_value')->nullable();
            $table->integer('data_items_sent')->default(0);
            $table->time('operating_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('module_histories', function (Blueprint $table) {
            //
        });
    }
};
