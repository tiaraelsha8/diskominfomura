<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('statistik_jk', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_kk')->default(0)->after('perempuan');
        });
    }

    public function down(): void
    {
        Schema::table('statistik_jk', function (Blueprint $table) {
            $table->dropColumn('jumlah_kk');
        });
    }
};