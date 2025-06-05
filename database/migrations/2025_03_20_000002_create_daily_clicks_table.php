<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_clicks', function (Blueprint $table) {
            $table->id();
            $table->string('slug_hash');
            $table->date('date');
            $table->unsignedBigInteger('clicks')->default(0);
            $table->unsignedBigInteger('unique_clicks')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('slug_hash')->references('slug_hash')->on('link_statistics')->cascadeOnDelete();
            $table->unique(['slug_hash', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_clicks');
    }
};
