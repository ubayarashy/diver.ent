<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('briefs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->json('categories');
            $table->decimal('budget', 15, 2)->nullable();
            $table->text('description')->nullable();
            
            // 3 Kolom baru yang ditambahkan:
            $table->string('timeline')->nullable();
            $table->string('phone');
            $table->string('reference_link')->nullable();
            
            $table->enum('status', ['pending', 'contacted', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('briefs');
    }
};