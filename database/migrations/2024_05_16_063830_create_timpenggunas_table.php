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
            $table->string('nomortps', 10);
            $table->string('kontak', 20);
            $table->text('alamat');
            $table->string('latitude', 40);
            $table->string('longitude', 40);
            $table->string('jenistim', 40);
            $table->string('id_dapil', 30);
            $table->integer('id_timinti', 10);
            $table->string('remember_token', 30);
            $table->text('foto');
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
