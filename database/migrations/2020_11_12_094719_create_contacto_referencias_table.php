<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_telefono_referencia');
            $table->string('numero_celular_referencia');
            $table->string('email_referencia');
            $table->integer('referencia_id');
         
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
        Schema::dropIfExists('contacto_referencias');
    }
}
