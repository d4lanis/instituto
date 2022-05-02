<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColegiadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegiados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_oficio');
            $table->timestamp('fecha_solicitud')->nullable();
            $table->string('motivo');
            $table->string('solicitud')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('notas')->nullable();

        

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
        Schema::dropIfExists('colegiados');
    }
}
