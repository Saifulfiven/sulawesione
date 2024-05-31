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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ktp',20);
            $table->string('desa',200);
            $table->string('jumlahpemilih', 10);
            $table->string('tps', 10);
            $table->string('telpon', 20);
            $table->string('latitude', 40);
            $table->string('longitude', 40);
            $table->string('yangdipilih', 30);
            $table->text('foto');
            $table->string('role', 30);
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
