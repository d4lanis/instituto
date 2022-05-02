<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meritos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merito_por_id');
            $table->integer('tipo_merito_id');
            $table->string('folio_interno');
            $table->timestamp('fecha_reconocimiento')->nullable();
            $table->string('notas');
            $table->integer('persona_id');
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
        Schema::dropIfExists('meritos');
    }
}
