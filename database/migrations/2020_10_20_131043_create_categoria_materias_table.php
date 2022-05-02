<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_materia_id')->nullable();
            $table->integer('categoria_materia_id')->nullable();
            $table->string('nombre');
            $table->string('descripcion');
            $table->bigInteger('lugares');
            $table->bigInteger('duracion');
            $table->double('calificacion_minima');
            $table->integer('grupo_id')->nullable();
            $table->softDeletes(); // <-- This will add a deleted_at field
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
        Schema::dropIfExists('materias');
    }
}
