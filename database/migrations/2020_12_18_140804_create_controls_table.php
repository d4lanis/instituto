<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id');
            $table->integer('tipo_control_confianza_id')->nullable();
            $table->integer('motivo_control_id')->nullable();
            $table->string('duracion')->nullable();
            $table->string('numero_oficio')->nullable();
            $table->timestamp('fecha_resultado')->nullable();
            $table->integer('resultado_id')->nullable();
            $table->timestamp('vigencia')->nullable();
            $table->string('observaciones')->nullable();
            
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
        Schema::dropIfExists('controls');
    }
}
