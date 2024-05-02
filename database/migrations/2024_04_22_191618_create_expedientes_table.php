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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caso_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->datetime('fecha_creacion');
            $table->boolean('eliminado')->default(false);
            $table->foreign('caso_id')->references('id')->on('casos');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
