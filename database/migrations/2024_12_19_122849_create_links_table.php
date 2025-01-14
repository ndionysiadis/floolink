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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 50)->unique();
            $table->text('original_url');
            $table->text('encrypted_url');
            $table->string('secret_key', 64)->nullable();
            $table->unsignedInteger('clicks')->default(0);
            $table->string('expiration_type', 64)->default('default');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
