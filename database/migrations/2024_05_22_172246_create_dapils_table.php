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
        Schema::create('dapils', function (Blueprint $table) {
            $table->id();
            
            $table->string('id_kabupaten', 10);
            $table->string('id_provinsi', 10);
            $table->string('id_kandidat', 10);
            $table->string('jeniskandidat', 100);
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
        Schema::dropIfExists('dapils');
    }
};
