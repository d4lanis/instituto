<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            //tabla de desempe'o y competencias basicas
            $table->increments('id');
            $table->integer('persona_id');
            $table->integer('tipo_evaluacion_id')->nullable();
            $table->string('duracion')->nullable();
            $table->timestamp('fecha_resultado')->nullable();
            $table->integer('resultado_id')->nullable();
            $table->string('tiempo_de_validez')->nullable();
            $table->text('observaciones')->nullable();
            
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
        Schema::dropIfExists('evaluacions');
    }
}
