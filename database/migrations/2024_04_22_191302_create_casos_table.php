<?php

use Carbon\Carbon;
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
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abogado_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('estado')->default('abierto');
            $table->string('nota_adicional')->nullable();
            $table->datetime('fecha_apertura');
            $table->datetime('fecha_cierre')->nullable();
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('abogado_id')->references('id')->on('users');
            $table->foreign('cliente_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};
