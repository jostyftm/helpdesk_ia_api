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
        Schema::table('roles', function (Blueprint $table) {
            $table->string('description')->nullable()->after('display_name');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreignId('module_permission_id')->constrained('module_permissions')->after('id');
            $table->string('display_name')->nullable()->after('name');
            $table->string('description')->nullable()->after('display_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('module_permission_id');
            $table->dropColumn('display_name');
            $table->dropColumn('description');
        });
    }
};
