<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonClaseAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_clase_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('salon_clase_id')->nullable();
            $table->integer('curso_alumno_id')->nullable();
            $table->double('calificacion')->nullable();
            $table->string('status')->default(0);
            $table->double('extra')->nullable();
            $table->integer('faltas')->nullable();
            $table->integer('grupo_id')->nullable();


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
        Schema::dropIfExists('salon_clase_alumnos');
    }
}
