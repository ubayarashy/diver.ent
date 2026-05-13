<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom yang kurang
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'creator', 'curator', 'admin'])->default('user')->after('bio');
            }
            if (!Schema::hasColumn('users', 'verified')) {
                $table->boolean('verified')->default(false)->after('role');
            }
            if (!Schema::hasColumn('users', 'follower_count')) {
                $table->integer('follower_count')->default(0)->after('verified');
            }
            if (!Schema::hasColumn('users', 'following_count')) {
                $table->integer('following_count')->default(0)->after('follower_count');
            }
            if (!Schema::hasColumn('users', 'cover_photo')) {
                $table->string('cover_photo')->nullable()->after('following_count');
            }
            if (!Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable()->after('cover_photo');
            }
            if (!Schema::hasColumn('users', 'website')) {
                $table->string('website')->nullable()->after('location');
            }
            if (!Schema::hasColumn('users', 'statistics')) {
                $table->json('statistics')->nullable()->after('website');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar', 'bio', 'role', 'verified', 
                'follower_count', 'following_count', 'cover_photo',
                'location', 'website', 'statistics'
            ]);
        });
    }
};