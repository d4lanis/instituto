<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSancionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sancions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origen_queja_id');
            $table->string('tipo_queja_id');
            $table->string('folio_interno');
            $table->string('asunto');
            $table->integer('tipo_sancion_id');
            $table->string('estado_sancion_id');
            $table->timestamp('fecha_inicio')->nullable();
            $table->timestamp('fecha_termino')->nullable();
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
        Schema::dropIfExists('sancions');
    }
}
