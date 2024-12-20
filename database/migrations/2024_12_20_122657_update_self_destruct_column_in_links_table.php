<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->boolean('self_destruct')->default(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->tinyInteger('self_destruct')->default(0)->change();
        });
    }
};
