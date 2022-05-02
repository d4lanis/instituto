<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id');
            $table->integer('motivo_cambio_id')->nullable();
            $table->timestamp('fecha_cambio')->nullable();
            $table->integer('puesto_id')->nullable();
            $table->integer('puesto_nuevo_id')->nullable();
            $table->string('acta_pdf')->nullable();
            
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
        Schema::dropIfExists('cambios');
    }
}
