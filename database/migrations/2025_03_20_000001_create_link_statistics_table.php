<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('slug_hash')->unique();
            $table->unsignedBigInteger('clicks')->default(0);
            $table->unsignedBigInteger('unique_clicks')->default(0);
            $table->timestamp('last_clicked_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_statistics');
    }
};
