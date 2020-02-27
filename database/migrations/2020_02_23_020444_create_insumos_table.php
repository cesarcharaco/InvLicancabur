<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('producto');
            $table->text('descripcion');
            $table->string('serial')->unique();
            $table->string('modelo')->nullable();
            $table->string('modulo')->nullable();
            $table->unsignedBigInteger('id_gerencia');
            $table->string('ubicacion');
            $table->integer('existencia')->default(0);
            $table->integer('in_almacen')->default(0);
            $table->integer('out_almacen')->default(0);
            $table->integer('disponibles')->default(0);
            $table->integer('entregados')->default(0)->nullable();
            $table->integer('en_reparacion')->default(0)->nullable();

            $table->foreign('id_gerencia')->references('id')->on('gerencias')->onDelete('cascade');
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
        Schema::dropIfExists('insumos');
    }
}
