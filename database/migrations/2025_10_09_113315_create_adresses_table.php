<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->string('numero', 10);
            $table->string('rue', 255);
            $table->string('ville', 100);
            $table->string('code_postal', 10);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('adresses');
    }
};

