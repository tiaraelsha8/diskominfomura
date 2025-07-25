<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->string('link_ig')->nullable()->after('telepon');
            $table->string('link_twitter')->nullable()->after('link_ig');
            $table->string('link_fb')->nullable()->after('link_twitter');
            $table->string('link_tiktok')->nullable()->after('link_fb');
            $table->string('link_youtube')->nullable()->after('link_tiktok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {
            $table->dropColumn(['link_ig', 'link_twitter', 'link_fb', 'link_tiktok', 'link_youtube']);
        });
    }
};
