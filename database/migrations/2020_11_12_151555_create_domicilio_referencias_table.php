<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomicilioReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      
        Schema::create('domicilio_referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calle_referencia');
            $table->string('colonia_referencia');
            $table->string('numero_exterior_referencia');
            $table->string('codigo_postal_referencia');
            $table->integer('estado_referencia_id');
            $table->integer('municipio_referencia_id');
            $table->integer('poblacion_referencia_id');
            $table->integer('referencia_id');
         
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domicilio_referencias');
    }
}
