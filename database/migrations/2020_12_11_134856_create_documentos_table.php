<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id');
            $table->string('foto_perfil')->nullable();
            $table->string('huellas')->nullable();
            $table->string('numero_seguro')->nullable();
            $table->string('no_habilitacion')->nullable();
            $table->string('solicitud_empleo')->nullable();
            $table->string('acta_de_nacimiento')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('cer_secundaria')->nullable();
            $table->string('cer_bachillerato')->nullable();
            $table->string('cer_tecnico')->nullable();
            $table->string('cer_profesional')->nullable();
            $table->string('comentario')->nullable();
           
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
        Schema::dropIfExists('documentos');
    }
}
