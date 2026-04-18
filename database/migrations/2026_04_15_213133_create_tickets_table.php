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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->foreignId('ticket_source_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('ticket_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('ticket_priority_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ticket_state_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_state_id')->constrained()->onDelete('cascade');
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_state_histories');
        Schema::dropIfExists('tickets');
    }
};
