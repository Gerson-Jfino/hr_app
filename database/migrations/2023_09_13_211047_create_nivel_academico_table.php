<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelAcademicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('nivel_academico')){
            Schema::create('nivel_academico', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedInteger('nivel_id');
                $table->foreign('nivel_id')->references('id')->on('nivel');
                $table->string('curso');
                $table->string('instituicao');
                $table->string('anexo')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nivel_academico');
    }
}
