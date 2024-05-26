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
        Schema::create('giftcards', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // Código de la tarjeta, varchar(50)
            $table->string('pin', 10); // PIN de la tarjeta, varchar(10)
            $table->string('phone', 50)->nullable(); // Teléfono asociado a la tarjeta, varchar(50)
            $table->string('email')->nullable();
            $table->boolean('status'); // Estado, booleano
            $table->foreignId('lotes_id')->nullable()->index(); // Clave foránea vinculada a la tabla lotes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giftcards');
    }
};
