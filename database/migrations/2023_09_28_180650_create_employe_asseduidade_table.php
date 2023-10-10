<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateEmployeAsseduidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employe_asseduidade')){
            Schema::create('employe_asseduidade', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('employe_id');
                $table->foreign('employe_id')->references('id')->on('employe');
                $table->date('data_inicio');
                $table->date('data_fim');
                $table->string('absentismo');
                $table->text('observacoes');
                $table->text('anexo');
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
        Schema::dropIfExists('employe_asseduidade');
    }
}
