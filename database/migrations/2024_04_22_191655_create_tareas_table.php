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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caso_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('estado')->default('abierto');
            $table->datetime('fecha_hora_asignacion');
            $table->datetime('fecha_hora_limite');
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('caso_id')->references('id')->on('casos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
