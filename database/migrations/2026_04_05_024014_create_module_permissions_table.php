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
        Schema::create('module_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('name')->unique();
            $table->string('path')->unique();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('show_sidebar')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_permissions');
    }
};
