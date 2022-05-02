<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNombramientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nombramientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id');
            $table->string('nombre_cargo_grado');
            $table->string('area_adscripcion');
            $table->string('nombre_documento_certifica');
            $table->timestamp('fecha_inicio');
            $table->integer('promedio');
            $table->string('documento_pdf')->nullable();
            
           
            
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
        Schema::dropIfExists('nombramientos');
    }
}
