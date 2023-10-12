<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;


class CreateDesempenhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desempenho', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employe_id');
            $table->foreign('employe_id')->references('id')->on('employe');
            $table->date('data_avalicao');
            $table->string('avaliacao');
            $table->string('anexo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desempenho');
    }
}
