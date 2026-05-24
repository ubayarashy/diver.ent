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
        Schema::table('users', function (Blueprint $table) {
            // Kita suruh Laravel membuat kolom 'role' tipe ENUM setelah kolom 'email'
            $table->enum('role', ['client', 'admin', 'team'])->default('client')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Antisipasi jika migration di-rollback, kolom 'role' dihapus lagi
            $table->dropColumn('role');
        });
    }
};