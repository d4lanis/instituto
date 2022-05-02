<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscolaridadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolaridads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_de_estudio');
            $table->string('nombre_de_institucion');
            $table->integer('nivel_escolar_id');
            $table->integer('estatus_id');
            $table->integer('fecha_inicio');
            $table->integer('fecha_conclusion');
            $table->integer('persona_id');
            $table->integer('curso_id')->nullable();
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
        Schema::dropIfExists('escolaridads');
    }
}
