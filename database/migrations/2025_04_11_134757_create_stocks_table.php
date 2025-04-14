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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicament_id')->constrained()->onDelete('cascade');
            $table->enum('type_mouvement', ['Entrée', 'Sortie', 'Vente']);
            $table->integer('quantite');
            $table->text('remarque')->nullable();
            $table->timestamp('date_mouvement')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
