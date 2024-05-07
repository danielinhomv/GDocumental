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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abogado_id');
            $table->unsignedBigInteger('caso_id');
            $table->string('descripcion');
            $table->string('nota_adicional')->nullable();
            $table->string('audio_url')->nullable();
            $table->datetime('fecha_creacion');
            $table->datetime('fecha_cierre');
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('abogado_id')->references('id')->on('users');
            $table->foreign('caso_id')->references('id')->on('casos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
