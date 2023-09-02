<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_alats', function (Blueprint $table) {
            $table->id('peminjaman_alat_id');
            $table->bigInteger('alat_id');
            $table->bigInteger('user_id');
            $table->string('nama_kegiatan');
            $table->string('pj_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->integer('alat_total');
            $table->date('tanggal_mulai');
            $table->time('waktu_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_selesai');
            $table->string('path_dokumen');
            $table->enum('status_peminjaman', ['proses','acc','tolak']);
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
        Schema::dropIfExists('peminjaman_alats');
    }
}