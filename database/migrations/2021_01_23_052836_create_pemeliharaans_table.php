<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeliharaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeliharaan', function (Blueprint $table) {
            $table->id('Kode_Pemeliharaan');
            $table->string('Kerusakan');
            $table->string('Faktor');
            $table->string('Pemeliharaan');
            $table->integer('Jumlah');
            $table->string('Foto');
            $table->integer('Status');
            $table->integer('Aset_ID');
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
        Schema::dropIfExists('pemeliharaan');
    }
}
