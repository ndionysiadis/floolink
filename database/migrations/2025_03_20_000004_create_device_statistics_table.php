<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('slug_hash');
            $table->string('device_type');
            $table->string('browser');
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('slug_hash')->references('slug_hash')->on('link_statistics')->cascadeOnDelete();
            $table->unique(['slug_hash', 'device_type', 'browser']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_statistics');
    }
};
