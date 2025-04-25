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
        Schema::create('cocteles_favoritos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 191);
            $table->text('instrucciones');
            $table->json('ingredientes');
            $table->integer('idDrink');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocteles_favoritos');
    }
};
