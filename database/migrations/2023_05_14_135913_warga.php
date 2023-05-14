<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Warga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_warga', function(Blueprint $bp){
            $bp->id();
            $bp->string('nama_lengkap', 80)->nullable(false);
            $bp->enum('gender', ['L','P'])->nullable(true);
            $bp->date('tgl_lahir')->nullable(true);
            $bp->string('alamat', 512)->nullable(true);
            $bp->text('lokasi')->nullable(false);
            $bp->unsignedBigInteger('pengguna_id');
            $bp->dateTime('dt_created');
            $bp->dateTime('dt_updated');
            $bp->foreign('pengguna_id', 'fk_tb_pengguna_id')
                ->on('tb_pengguna')->references('id')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_warga');
    }
}
