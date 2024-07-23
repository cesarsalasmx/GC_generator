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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->text('comentarios')->nullable();  // comentarios: text
            $table->integer('cantidad_gc');  // cantidad_gc: int
            $table->date('vigencia_gc');  // vigencia_gc: date
            $table->string('prefijo_gc', 50)->nullable();  // prefijo_gc: varchar(50)
            $table->float('valor_gc', 8, 2);  // valor_gc: float, 8 dígitos en total y 2 decimales
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('tienda_id')->nullable()->index();
            $table->string('rfc');
            $table->string('razon_social');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
