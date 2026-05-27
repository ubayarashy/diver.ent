<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('briefs', function (Blueprint $table) {
            $table->enum('status', ['pending', 'contacted', 'approved', 'rejected', 'in_progress', 'waiting_approval', 'revision', 'completed'])
                ->default('pending')
                ->change();
        });
    }

    public function down()
    {
        // Rollback tidak bisa untuk enum, cukup hapus atau abaikan
    }
};