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
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('link_whatsapp')->nullable()->after('link_youtube');

            // decimal(10,7) cukup presisi untuk koordinat lat/long
            // nullable karena data lama belum punya koordinat
            $table->decimal('latitude', 10, 7)->nullable()->after('link_whatsapp');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['link_whatsapp', 'latitude', 'longitude']);
        });
    }
};