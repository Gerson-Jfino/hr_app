<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('personal_data')){
            Schema::create('personal_data', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('nome_completo');
                $table->string('nuit');
                $table->date('data_nascimento');
                $table->string('genero');
                $table->string('estado_civil');
                $table->string('nacionalidade');
                $table->string('tipo_documento');
                $table->string('nr_documento');
                $table->string('anexo_documento');
                $table->string('endereco');
                $table->string('bairro');
                $table->string('cod_postal')->nullable();
                $table->string('provincia');
                $table->string('distrito');
                $table->string('cidade')->nullable();
                $table->string('email');
                $table->string('email_sec')->nullable();
                $table->string('contacto');
                $table->string('contacto_sec')->nullable();
                $table->string('cell')->nullable();
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
        Schema::dropIfExists('personal_data');
    }
}
