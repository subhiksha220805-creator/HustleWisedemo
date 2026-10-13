<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_settings', function (Blueprint $table) {
            $table->string('content_key')->primary();
            $table->longText('content_value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_settings');
    }
};
