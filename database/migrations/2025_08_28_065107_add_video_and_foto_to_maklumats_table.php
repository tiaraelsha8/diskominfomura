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
        Schema::table('maklumats', function (Blueprint $table) {
            $table->string('video')->nullable()->after('id'); // bisa simpan URL / nama file
            $table->string('foto')->nullable()->after('video'); // simpan path foto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maklumats', function (Blueprint $table) {
            $table->dropColumn(['video', 'foto']);
        });
    }
};
