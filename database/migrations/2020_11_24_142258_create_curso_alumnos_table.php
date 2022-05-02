<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id');
            $table->integer('persona_id');
            $table->string('status')->default(0);
            $table->integer('faltas')->nullable();
            $table->integer('grupo_id')->default(1);

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
        Schema::dropIfExists('curso_alumnos');
    }
}
