<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->enum('jk', ['L', 'P']);
            $table->unsignedSmallInteger('umur')->nullable();
            $table->string('status_kawin')->nullable();
            $table->string('agama')->nullable();
            $table->string('hub_krt')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('status_bekerja')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('sektor')->nullable();
            $table->string('jenis_disabilitas')->nullable();
            $table->string('jenis_penyakit')->nullable();
            $table->timestamps();

            $table->index('umur');
            $table->index('jk');
            $table->index('agama');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};