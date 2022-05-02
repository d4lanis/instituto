<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiliacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filiacions', function (Blueprint $table) {
            $table->id();

            $table->integer('complexion_id');
            $table->integer('color_piel_id');
            $table->integer('cantidad_de_cabello_id');
            $table->integer('color_de_cabello_id');
            $table->integer('forma_de_cabello_id');
            $table->integer('color_de_ojos_id');
            $table->integer('size_de_ojos_id');
            $table->integer('size_de_nariz_id');
            $table->integer('size_de_boca_id');
            $table->integer('forma_de_cara_id');
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
        Schema::dropIfExists('filiacions');
    }
}
