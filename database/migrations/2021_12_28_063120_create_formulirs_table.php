<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftars')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->string('nisn');
            $table->string('nik');
            $table->string('gender');
            $table->string('ttl');
            $table->string('agama');
            $table->string('status_keluarga');
            $table->string('anak_ke');
            $table->string('jml_saudara');
            $table->text('hobi');
            $table->text('cita');
            $table->text('asal_sekolah');
            $table->text('tinggal');
            $table->text('alamat');
            $table->string('jarak');
            $table->string('tranportasi');
            $table->string('phone');
            $table->string('no_kk');
            $table->string('kepala_keluarga');
            $table->string('nama_ayah');
            $table->string('nik_ayah');
            $table->string('ttl_ayah');
            $table->string('status_ayah');
            $table->string('pendidikan_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('phone_ayah');
            $table->string('nama_ibu');
            $table->string('nik_ibu');
            $table->string('ttl_ibu');
            $table->string('status_ibu');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('phone_ibu');
            $table->string('nama_wali');
            $table->string('nik_wali');
            $table->string('ttl_wali');
            $table->string('status_wali');
            $table->string('pendidikan_wali');
            $table->string('pekerjaan_wali');
            $table->string('penghasilan_wali');
            $table->string('phone_wali');

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
        Schema::dropIfExists('formulirs');
    }
}
