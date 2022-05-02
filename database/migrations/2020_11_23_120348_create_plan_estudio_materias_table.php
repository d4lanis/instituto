<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanEstudioMateriasTable extends Migration
{
    /**
     * Run the migrations.  
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planestudiomaterias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materia_id');
            $table->integer('plan_estudio_id');


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
        Schema::dropIfExists('planestudiomaterias');
    }
}
