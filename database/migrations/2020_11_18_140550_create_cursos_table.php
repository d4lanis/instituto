<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_termino')->nullable();
            $table->string('oficio_numero');
            $table->timestamp('oficio_fecha')->nullable();
            $table->timestamp('kardex_fecha')->nullable();
            $table->integer('status_id')->default(0);
            $table->integer('status_curso')->nullable();
            $table->integer('plan_estudio_id');

         
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
        Schema::dropIfExists('cursos');
    }
}
