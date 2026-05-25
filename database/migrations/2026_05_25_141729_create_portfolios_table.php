<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // social, web, ads, brand, video, seo
            $table->string('label');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('year')->nullable();
            $table->json('results')->nullable(); // untuk menyimpan hasil seperti engagement, ROI, dll
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
};