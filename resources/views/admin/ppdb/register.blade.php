@extends('templates.admin.index',['title'=>'Pendaftaran Peserta Didik Baru'])
@section('content')
    <div class="card">
        <div class="row">
            @if (!Auth::user()->ppdb)
                <div class="col-12 text-center">
                    <h3 class="mt-5">Pendaftaran Peserta Didik Baru</h3>
                    <h5 class="text-secondary font-weight-normal">SMP Terpadu Darur Roja Tahun Ajaran
                        {{ Carbon\Carbon::now()->format('Y') .'/' .Carbon\Carbon::now()->addYear()->format('Y') }}</h5>
                    <div class="multisteps-form mb-5">
                        <!--progress bar-->
                        <div class="row">
                            <div class="col-12 col-lg-12 mx-auto my-5">
                                <div class="multisteps-form__progress">
                                    <button class="multisteps-form__progress-btn js-active" type="button"
                                        title="Biodata Calon Siswa">
                                        <span>Biodata Calon Siswa</span>
                                    </button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Biodata Ayah">
                                        <span>Biodata Ayah</span>
                                    </button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Biodata Ibu">
                                        <span>Biodata Ibu</span>
                                    </button>
                                    <button class="multisteps-form__progress-btn" type="button" title="Biodata Wali">
                                        <span>Biodata Wali</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--form panels-->
                        <div class="row">
                            <div class="col-12 col-lg-12 m-auto">
                                <form class="multisteps-form__form" action="{{ url('ppdb/register') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!--single form panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-4">
                                                    <div class="avatar avatar-xxl position-relative">
                                                        <img src="{{ asset('images/avatar.png') }}"
                                                            class="border-radius-md" id='imagePreview'
                                                            alt="{{ asset('images/avatar.png') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('foto') is-invalid @enderror"
                                                        type="file" name="foto" onchange="preview(this);"
                                                        value="{{ old('foto') }}">
                                                    @error('foto')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Nama Lengkap</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nama') is-invalid @enderror"
                                                        type="text" name="nama" placeholder="Eg. Michael"
                                                        value="{{ old('nama') ?? Auth::user()->name }}" />
                                                    @error('nama')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Telephone</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('phone') is-invalid @enderror"
                                                        type="text" name="phone" placeholder="6565..."
                                                        value="{{ old('phone') ?? Auth::user()->phone }}" />
                                                    @error('phone')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>NISN</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nisn') is-invalid @enderror"
                                                        type="text" name="nisn" placeholder="657.."
                                                        value="{{ old('nisn') }}" />
                                                    @error('nisn')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Kartu Keluarga</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nokk') is-invalid @enderror"
                                                        type="text" name="nokk" placeholder="6565..."
                                                        value="{{ old('nokk') }}" />
                                                    @error('nokk')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Induk Kependudukan</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nik') is-invalid @enderror"
                                                        type="text" name="nik" placeholder="6565..."
                                                        value="{{ old('nik') }}" />
                                                    @error('nik')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Akta Kelahiran</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('no_akta_kelahiran') is-invalid @enderror"
                                                        type="text" name="no_akta_kelahiran" placeholder="6565..."
                                                        value="{{ old('no_akta_kelahiran') }}" />
                                                    @error('no_akta_kelahiran')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Gender</label>
                                                    <select class="form-control mb-3 @error('gender') is-invalid @enderror"
                                                        name="gender">
                                                        <option selected>Pilih Gender</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Agama</label>
                                                    <select class="form-control mb-3 @error('agama') is-invalid @enderror"
                                                        name="agama">
                                                        <option selected>Pilih Agama</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Hindu">Hindu</option>
                                                    </select>
                                                    @error('agama')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Tempat Tanggal Lahir</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('ttl') is-invalid @enderror"
                                                        type="text" name="ttl" placeholder="Blitar, 04 Desember 2000"
                                                        value="{{ old('ttl') }}" />
                                                    @error('ttl')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Status Keluarga</label>
                                                    <select
                                                        class="form-control mb-3 @error('status_keluarga') is-invalid @enderror"
                                                        name="status_keluarga">
                                                        <option selected>Pilih Status Keluarga</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Hindu">Hindu</option>
                                                    </select>
                                                    @error('status_keluarga')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Anak Ke</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('anak_ke') is-invalid @enderror"
                                                        type="text" name="anak_ke" placeholder="1"
                                                        value="{{ old('anak_ke') }}" />
                                                    @error('anak_ke')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Jumlah Saudara</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('jml_saudara') is-invalid @enderror"
                                                        type="text" name="jml_saudara" placeholder="2"
                                                        value="{{ old('jml_saudara') }}" />
                                                    @error('jml_saudara')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Hobi</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('hobi') is-invalid @enderror"
                                                        type="text" name="hobi" placeholder="Basket"
                                                        value="{{ old('hobi') }}" />
                                                    @error('hobi')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Cita-cita</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('cita') is-invalid @enderror"
                                                        type="text" name="cita" placeholder="Pilot"
                                                        value="{{ old('cita') }}" />
                                                    @error('cita')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Alamat</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('alamat') is-invalid @enderror"
                                                        type="text" name="alamat" placeholder="Desa ....."
                                                        value="{{ old('alamat') }}" />
                                                    @error('alamat')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Asal Sekolah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('asal_sekolah') is-invalid @enderror"
                                                        type="text" name="asal_sekolah" placeholder="SD Negeri..."
                                                        value="{{ old('asal_sekolah') }}" />
                                                    @error('asal_sekolah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Sebelumnya">Sebelumnya</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                        type="button" title="Selanjutnya">Selanjutnya</button>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12 col-sm-4">
                                                </div>
                                                <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                    <label>Nama Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nama_ayah') is-invalid @enderror"
                                                        type="text" name="nama_ayah" placeholder="Eg. Michael"
                                                        value="{{ old('nama_ayah') }}" />
                                                    @error('nama_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>NIK</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nik_ayah') is-invalid @enderror"
                                                        type="text" name="nik_ayah" placeholder="657.."
                                                        value="{{ old('nik_ayah') }}" />
                                                    @error('nik_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Tempat Tanggal Lahir</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('ttl_ayah') is-invalid @enderror"
                                                        type="text" name="ttl_ayah" placeholder="Blitar, 04 Desember 2000"
                                                        value="{{ old('ttl_ayah') }}" />
                                                    @error('ttl_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Telephone Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('phone_ayah') is-invalid @enderror"
                                                        type="text" name="phone_ayah" placeholder="6565..."
                                                        value="{{ old('phone_ayah') }}" />
                                                    @error('phone_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Status Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('status_ayah') is-invalid @enderror"
                                                        type="text" name="status_ayah" placeholder="6565..."
                                                        value="{{ old('status_ayah') }}" />
                                                    @error('status_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pendidikan Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pendidikan_ayah') is-invalid @enderror"
                                                        type="text" name="pendidikan_ayah" placeholder="SMP"
                                                        value="{{ old('pendidikan_ayah') }}" />
                                                    @error('pendidikan_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pekerjaan Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pekerjaan_ayah') is-invalid @enderror"
                                                        type="text" name="pekerjaan_ayah" placeholder="Petani"
                                                        value="{{ old('pekerjaan_ayah') }}" />
                                                    @error('pekerjaan_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Penghasilan Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('penghasilan_ayah') is-invalid @enderror"
                                                        type="integer" name="penghasilan_ayah" placeholder="500000"
                                                        value="{{ old('penghasilan_ayah') }}" />
                                                    @error('penghasilan_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Alamat Ayah</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('alamat_ayah') is-invalid @enderror"
                                                        type="text" name="alamat_ayah" placeholder="Desa ....."
                                                        value="{{ old('alamat_ayah') }}" />
                                                    @error('alamat_ayah')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Sebelumnya">Sebelumnya</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Sebelumnya">Sebelumnya</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                        type="button" title="Selanjutnya">Selanjutnya</button>
                                                </div>
                                            </div>
                                            <div class="row text-start">
                                                <div class="col-12 col-sm-4">
                                                </div>
                                                <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                    <label>Nama Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nama_ibu') is-invalid @enderror"
                                                        type="text" name="nama_ibu" placeholder="Eg. Michael"
                                                        value="{{ old('nama_ibu') }}" />
                                                    @error('nama_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>NIK Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nik_ibu') is-invalid @enderror"
                                                        type="text" name="nik_ibu" placeholder="657.."
                                                        value="{{ old('nik_ibu') }}" />
                                                    @error('nik_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Tempat Tanggal Lahir Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('ttl_ibu') is-invalid @enderror"
                                                        type="text" name="ttl_ibu" placeholder="Blitar, 04 Desember 2000"
                                                        value="{{ old('ttl_ibu') }}" />
                                                    @error('ttl_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Telephone Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('phone_ibu') is-invalid @enderror"
                                                        type="text" name="phone_ibu" placeholder="6565..."
                                                        value="{{ old('phone_ibu') }}" />
                                                    @error('phone_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Status Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('status_ibu') is-invalid @enderror"
                                                        type="text" name="status_ibu" placeholder="6565..."
                                                        value="{{ old('status_ibu') }}" />
                                                    @error('status_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pendidikan Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pendidikan_ibu') is-invalid @enderror"
                                                        type="text" name="pendidikan_ibu" placeholder="SMP"
                                                        value="{{ old('pendidikan_ibu') }}" />
                                                    @error('pendidikan_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pekerjaan Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pekerjaan_ibu') is-invalid @enderror"
                                                        type="text" name="pekerjaan_ibu" placeholder="Petani"
                                                        value="{{ old('pekerjaan_ibu') }}" />
                                                    @error('pekerjaan_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Penghasilan Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('penghasilan_ibu') is-invalid @enderror"
                                                        type="integer" name="penghasilan_ibu" placeholder="500000"
                                                        value="{{ old('penghasilan_ibu') }}" />
                                                    @error('penghasilan_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Alamat Ibu</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('alamat_ibu') is-invalid @enderror"
                                                        type="text" name="alamat_ibu" placeholder="Desa ....."
                                                        value="{{ old('alamat_ibu') }}" />
                                                    @error('alamat_ibu')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Sebelumnya">Sebelumnya</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                        type="button" title="Selanjutnya">Selanjutnya</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <div class="multisteps-form__content">
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Sebelumnya">Sebelumnya</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                        title="Kirim">Kirim</button>
                                                </div>
                                            </div>
                                            <div class="row text-start">
                                                <div class="col-12 col-sm-4">
                                                </div>
                                                <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                    <label>Nama Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nama_wali') is-invalid @enderror"
                                                        type="text" name="nama_wali" placeholder="Eg. Michael"
                                                        value="{{ old('nama_wali') }}" />
                                                    @error('nama_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>NIK Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('nik_wali') is-invalid @enderror"
                                                        type="text" name="nik_wali" placeholder="657.."
                                                        value="{{ old('nik_wali') }}" />
                                                    @error('nik_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Tempat Tanggal Lahir Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('ttl_wali') is-invalid @enderror"
                                                        type="text" name="ttl_wali" placeholder="Blitar, 04 Desember 2000"
                                                        value="{{ old('ttl_wali') }}" />
                                                    @error('ttl_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>No Telephone Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('phone_wali') is-invalid @enderror"
                                                        type="text" name="phone_wali" placeholder="6565..."
                                                        value="{{ old('phone_wali') }}" />
                                                    @error('phone_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Status Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('status_wali') is-invalid @enderror"
                                                        type="text" name="status_wali" placeholder="6565..."
                                                        value="{{ old('status_wali') }}" />
                                                    @error('status_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pendidikan Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pendidikan_wali') is-invalid @enderror"
                                                        type="text" name="pendidikan_wali" placeholder="SMP"
                                                        value="{{ old('pendidikan_wali') }}" />
                                                    @error('pendidikan_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Pekerjaan Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('pekerjaan_wali') is-invalid @enderror"
                                                        type="text" name="pekerjaan_wali" placeholder="Petani"
                                                        value="{{ old('pekerjaan_wali') }}" />
                                                    @error('pekerjaan_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Penghasilan Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('penghasilan_wali') is-invalid @enderror"
                                                        type="integer" name="penghasilan_wali" placeholder="500000"
                                                        value="{{ old('penghasilan_wali') }}" />
                                                    @error('penghasilan_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                    <label>Alamat Wali</label>
                                                    <input
                                                        class="multisteps-form__input form-control mb-3 @error('alamat_wali') is-invalid @enderror"
                                                        type="text" name="alamat_wali" placeholder="Desa ....."
                                                        value="{{ old('alamat_wali') }}" />
                                                    @error('alamat_wali')
                                                        <div class="alert alert-danger text-white" role="alert">
                                                            {{ $message }}!
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Sebelumnya">Sebelumnya</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                        title="Kirim">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center mb-6">
                    <h3 class="mt-5">Pendaftaran Peserta Didik Baru</h3>
                    <h5 class="text-secondary font-weight-normal">SMP Terpadu Darur Roja Tahun Ajaran
                        {{ Carbon\Carbon::now()->format('Y') .'/' .Carbon\Carbon::now()->addYear()->format('Y') }}</h5>
                    <center>
                        <hr>
                        <div class="col-lg-7 mb-lg-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="d-flex flex-column h-100">
                                                <h5 class="font-weight-bolder">Status Pendaftaran</h5>
                                                @if (Auth::user()->ppdb->status == 1)
                                                    <div class="alert alert-success alert-dismissible fade show  text-white "
                                                        role="alert">
                                                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                                        <span class="alert-text"><strong>Diterima!</strong> Pendaftaran
                                                            anda
                                                            telah diterima!</span>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @elseif (Auth::user()->ppdb->status == 2)
                                                    <div class="alert alert-danger alert-dismissible fade show  text-white "
                                                        role="alert">
                                                        <span class="alert-text"><strong>Ditolak!</strong> Mohon Maaf
                                                            Pendaftaran
                                                            anda ditolak oleh Admin, Terima kasih atas partisipasi anda dan
                                                            tetap semangat!</span>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning alert-dismissible fade show  text-white "
                                                        role="alert">
                                                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                                        <span class="alert-text"><strong>Menunggu!</strong> Pendaftaran
                                                            anda
                                                            masih diproses!</span>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <a href="{{ url('ppdb/data') }}" class="btn btn-secondary">Cek
                                                        Data</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-5 ms-auto text-center">
                                            <div class="bg-gradient-primary border-radius-lg h-100">
                                                <img src="http://127.0.0.1:8000/soft/assets/img/shapes/waves-white.svg"
                                                    class="position-absolute h-100 w-50 top-0 d-lg-block d-none"
                                                    alt="waves">
                                                <div
                                                    class="position-relative d-flex align-items-center justify-content-center h-100">
                                                    <img class="w-100 position-relative z-index-2"
                                                        src="{{ asset('images/logo.jpg') }}" alt="Logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
            @endif
        </div>
    </div>
    </div>
@endsection
@push('css')
    <link href="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/css/soft-ui-dashboard.min.css?v=1.0.0"
        rel="stylesheet">
@endpush
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://demos.creative-tim.com/test/soft-ui-dashboard-pro/assets/js/plugins/multistep-form.js"
        type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var hasError = "{{ session('error') }}";
            var hasStatus = "{{ session('status') }}";
            if (hasError != "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                })
            }
            if (hasStatus != "") {
                Swal.fire(
                    'Good job!',
                    "{{ session('status') }}",
                    'success'
                )
            }

        });

        function preview(foto) {
            if (foto.files && foto.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(foto.files[0]);
            }
        }

        function deleteForm(id) {
            Swal.fire({
                title: 'Apa kamu yakin menghapusnya?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Dihapus!', '', 'success');
                    $.ajax({
                        url: '{{ url('admin/pengurus/delete') }}',
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Data berhasil dihapus!', '', 'success');
                                // $('#datatable').DataTable().ajax.reload();
                                location.reload();
                            }
                        },
                        error: function(e) {
                            Swal.fire('Terjadi kesalahan!! silakan coba beberapa lagi', '',
                                'error');
                            // $('#datatable').DataTable().ajax.reload();
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Tidak jadi dihapus', '', 'info')
                }
            });
        }
    </script>
@endpush
