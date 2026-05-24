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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Diarahkan langsung ke tabel 'briefs' karena kamu pakai briefs sebagai project
            $table->foreignId('project_id')->constrained('briefs')->onDelete('cascade'); 
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade'); 
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'review', 'revision', 'completed'])->default('pending');
            $table->integer('progress')->default(0);
            $table->date('deadline');
            $table->timestamps(); // Ini bawaan Laravel, biarkan saja
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};