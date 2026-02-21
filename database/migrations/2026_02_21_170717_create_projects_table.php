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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Para a URL amigável
            $table->string('cover_image')->nullable();
            $table->text('summary')->nullable(); // Para o card do carrossel/lista
            $table->longText('content')->nullable(); // O Markdown completo
            $table->boolean('is_featured')->default(false); // Checkbox da Home
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
