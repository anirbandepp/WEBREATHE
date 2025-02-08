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
        Schema::create('module_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'warning', 'broken', 'updated'])->default('active');
            $table->timestamp('operation_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_histories');
    }
};
