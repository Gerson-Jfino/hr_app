<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sector')){
            Schema::create('sector', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('uni_org_id');
                $table->foreign('uni_org_id')->references('id')->on('unidade_organica');
                $table->unsignedInteger('regiao_id');
                $table->foreign('regiao_id')->references('id')->on('regiao');
                $table->string('name');
                $table->timestamps();
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
        Schema::dropIfExists('sector');
    }
}
