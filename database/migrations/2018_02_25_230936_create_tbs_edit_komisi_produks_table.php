<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbsEditKomisiProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbs_edit_komisi_produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_reg');
            $table->integer('komisi_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('produk_id')->unsigned();
            $table->integer('nominal_komisi');
            $table->timestamps();
            $table->auditable();
            $table->foreign('no_reg')->references('no_reg')->on('registrasi_pasiens');
            $table->foreign('komisi_id')->references('id')->on('komisi_produks');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('produk_id')->references('id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbs_edit_komisi_produks');
    }
}
