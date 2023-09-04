<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadeOrganicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('unidade_organica', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pelouro_id');
            $table->foreign('pelouro_id')->references('id')->on('pelouro');
            $table->string('name');
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
        Schema::dropIfExists('unidade_organica');
    }
}
