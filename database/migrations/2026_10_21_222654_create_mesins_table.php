<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mesins', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();
            $table->string('jenis', 30);
            $table->string('merek', 50);
            $table->unsignedInteger('kapasitas_kg');
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mesins');
    }
};