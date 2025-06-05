<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geographic_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('slug_hash');
            $table->string('country');
            $table->string('region')->nullable();
            $table->unsignedBigInteger('clicks')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('slug_hash')->references('slug_hash')->on('link_statistics')->cascadeOnDelete();
            $table->unique(['slug_hash', 'country', 'region']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geographic_statistics');
    }
};
