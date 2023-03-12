<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencias', function (Blueprint $table) {
            $table->id('id');
            $table->text('data_chamada');
            $table->integer('realizada', false, true);
            $table->integer('rota_id')->unsigned();
            $table->timestamps();
            $table->foreign('rota_id')->references('id')->on('rotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('frequencias');
    }
};
