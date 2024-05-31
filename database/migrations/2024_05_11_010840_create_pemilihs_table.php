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
        Schema::create('pemilihs', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('kontak', 20);
            $table->text('alamat');
            $table->tinyInteger('jenispilihan');
            $table->string('id_dapil', 10);
            $table->string('id_timpengguna', 10);
            $table->string('id_desa', 200);
            $table->string('id_kecamatan', 10);
            $table->string('id_kabupaten', 10);
            $table->string('id_provinsi', 10);
            $table->timestamps();
            //$table->increments('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemilihs');
    }
};
