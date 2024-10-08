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
        Schema::create('timpenggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama',255);
            $table->string('ktp',20);
            $table->integer('id_desa');
            $table->integer('id_kecamatan');
            $table->integer('id_kabupaten');
            $table->integer('id_provinsi');
            $table->string('jumlahpemilihrumahtangga', 10);
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
        Schema::dropIfExists('timpenggunas');
    }
};
