<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_jk_rt', function (Blueprint $table) {
            $table->id();
            $table->string('rt', 50)->unique();
            $table->unsignedInteger('laki_laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->unsignedInteger('jumlah_kk')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_jk_rt');
    }
};