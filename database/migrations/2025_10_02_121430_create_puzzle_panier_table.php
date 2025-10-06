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
        Schema::create('panier_puzzle', function (Blueprint $table) {
            $table->foreignId('panier_id')->constrained('paniers')->onDelete('cascade');
            $table->foreignId('puzzle_id')->constrained('puzzles')->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->primary(['panier_id', 'puzzle_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puzzle_panier');
    }
};
