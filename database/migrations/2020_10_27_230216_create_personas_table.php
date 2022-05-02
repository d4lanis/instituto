<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
        
            $table->string('numero_convocatoria')->nullable();
            $table->timestamp('fecha_ingreso')->nullable();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->integer('edad')->nullable();
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento');
            $table->integer('sexo_id')->nullable();
            $table->integer('estado_civil_id')->nullable();
            $table->integer('tipo_sanguineo_id')->nullable();
            $table->integer('categoria_puestos_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('rfc');
            $table->string('curp');
            $table->string('cuip')->nullable();
          
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('personas');
    }
}
