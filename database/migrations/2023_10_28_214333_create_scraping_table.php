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
        Schema::create('scraping', function (Blueprint $table) {
            $table->string('Id');
            $table->string('CLEE');
            $table->string('Nombre');
            $table->string('Razon_social');
            $table->string('Clase_actividad');
            $table->string('Estrato');
            $table->string('Tipo_vialidad');
            $table->string('Calle');
            $table->string('Num_Exterior');
            $table->string('Num_Interior');
            $table->string('Colonia');
            $table->string('CP');
            $table->string('Ubicacion');
            $table->string('Telefono');
            $table->string('Correo_e');
            $table->string('Sitio_internet');
            $table->string('Tipo');
            $table->string('Longitud');
            $table->string('Latitud');
            $table->string('CentroComercial');
            $table->string('TipoCentroComercial');
            $table->string('NumLocal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scraping');
    }
};
