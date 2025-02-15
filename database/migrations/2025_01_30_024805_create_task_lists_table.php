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
        Schema::create('task_lists', function (Blueprint $table)
        // schema::create adalah metode yang digunakan untuk membuat table baru di database
        // tasklist adalah nama table yang akan dibuat 
        // blue print $table digunakan untuk mendefinisikan struktur tabel dengan mudah

        {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_lists');
    }
    // Schema::dropIfExists('task_lists') → Menghapus tabel task_lists dari database jika tabel tersebut ada
};
