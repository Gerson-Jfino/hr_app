<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employe')){
            Schema::create('employe', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('nome_completo');
                $table->date('data_admissao');
                $table->date('data_fim')->nullable();
                $table->unsignedInteger('situation_id');
                $table->foreign('situation_id')->references('id')->on('situation');
                $table->date('data_situacao');
                $table->unsignedInteger('pelouro_id');
                $table->foreign('pelouro_id')->references('id')->on('pelouro');
                $table->unsignedInteger('uni_org_id');
                $table->foreign('uni_org_id')->references('id')->on('unidade_organica');
                $table->unsignedInteger('sector_id');
                $table->foreign('sector_id')->references('id')->on('sector');
                $table->unsignedInteger('categoria_id');
                $table->foreign('categoria_id')->references('id')->on('categoria');
                $table->unsignedInteger('nivel_id');
                $table->foreign('nivel_id')->references('id')->on('nivel');
                $table->bigInteger('salario');
                $table->string('inss');
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
        Schema::dropIfExists('employe');
    }
}
