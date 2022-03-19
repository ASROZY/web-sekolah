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
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('foto');
            $table->text('nama');
            $table->text('nisn');
            $table->text('nokk');
            $table->text('nik');
            $table->text('gender');
            $table->text('no_akta_kelahiran');
            $table->text('ttl');
            $table->text('agama');
            $table->text('status_keluarga');
            $table->text('anak_ke');
            $table->text('jml_saudara');
            $table->text('hobi');
            $table->text('cita');
            $table->text('asal_sekolah');
            $table->text('alamat');
            $table->text('phone');
            $table->text('nama_ayah');
            $table->text('nik_ayah');
            $table->text('ttl_ayah');
            $table->text('status_ayah');
            $table->text('pendidikan_ayah');
            $table->text('pekerjaan_ayah');
            $table->text('penghasilan_ayah');
            $table->text('phone_ayah');
            $table->text('alamat_ayah');
            $table->text('nama_ibu');
            $table->text('nik_ibu');
            $table->text('ttl_ibu');
            $table->text('status_ibu');
            $table->text('pendidikan_ibu');
            $table->text('pekerjaan_ibu');
            $table->text('penghasilan_ibu');
            $table->text('phone_ibu');
            $table->text('alamat_ibu');
            $table->text('nama_wali');
            $table->text('nik_wali');
            $table->text('ttl_wali');
            $table->text('status_wali');
            $table->text('pendidikan_wali');
            $table->text('pekerjaan_wali');
            $table->text('penghasilan_wali');
            $table->text('phone_wali');
            $table->text('alamat_wali');
            $table->integer('status')->default(0);
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
