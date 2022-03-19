@extends('templates.admin.index',['title'=>'Data Pendaftaran Peserta Didik Baru'])
@section('content')
    <div class="card">
        <div class="row">
            <div class="col-12 text-center">
                <h3 class="mt-5">Data Pendaftaran Peserta Didik Baru</h3>
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
                                        <div class="row mt-3">
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="avatar avatar-xxl position-relative">
                                                    <img src="{{ asset($data->foto) }}" class="border-radius-md"
                                                        alt="{{ asset($data->foto) }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                <label>Nama Lengkap</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nama" placeholder="Eg. Michael" value="{{ $data->nama }}"
                                                    disabled />
                                                <label>No Telephone</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="phone" placeholder="6565..." value="{{ $data->phone }}"
                                                    disabled />
                                                <label>NISN</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nisn" placeholder="657.." value="{{ $data->nisn }}" disabled />
                                                <label>No Kartu Keluarga</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nokk" placeholder="6565..." value="{{ $data->nokk }}"
                                                    disabled />
                                                <label>No Induk Kependudukan</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nik" placeholder="6565..." value="{{ $data->nik }}" disabled />
                                                <label>No Akta Kelahiran</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="no_akta_kelahiran" placeholder="6565..."
                                                    value="{{ $data->no_akta_kelahiran }}" disabled />
                                                <label>Gender</label>
                                                <select class="form-control mb-3 @error('type') is-invalid @enderror"
                                                    name="gender" disabled>
                                                    <option selected>{{ $data->gender }}</option>
                                                </select>
                                                <label>Agama</label>
                                                <select class="form-control mb-3 @error('type') is-invalid @enderror"
                                                    name="agama" disabled>
                                                    <option selected>{{ $data->agama }}</option>
                                                </select>
                                                <label>Tempat Tanggal Lahir</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="ttl" placeholder="Blitar, 04 Desember 2000"
                                                    value="{{ $data->ttl }}" disabled />
                                                <label>Status Keluarga</label>
                                                <select
                                                    class="form-control mb-3 @error('status_keluarga') is-invalid @enderror"
                                                    name="status_keluarga" disabled>
                                                    <option selected>{{ $data->status_keluarga }}</option>
                                                </select>
                                                <label>Anak Ke</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="anak_ke" placeholder="1" value="{{ $data->anak_ke }}"
                                                    disabled />
                                                <label>Jumlah Saudara</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="jml_saudara" placeholder="2" value="{{ $data->jml_saudara }}"
                                                    disabled />
                                                <label>Hobi</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="hobi" placeholder="Basket" value="{{ $data->hobi }}"
                                                    disabled />
                                                <label>Cita-cita</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="cita" placeholder="Pilot" value="{{ $data->cita }}" disabled />
                                                <label>Alamat</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="alamat" placeholder="Desa ....." value="{{ $data->alamat }}"
                                                    disabled />
                                                <label>Asal Sekolah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="asal_sekolah" placeholder="SD Negeri..."
                                                    value="{{ $data->asal_sekolah }}" disabled />
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
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12 col-sm-4">
                                            </div>
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                <label>Nama Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nama_ayah" placeholder="Eg. Michael"
                                                    value="{{ $data->nama_ayah }}" disabled />
                                                <label>NIK</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nik_ayah" placeholder="657.." value="{{ $data->nik_ayah }}"
                                                    disabled />
                                                <label>Tempat Tanggal Lahir</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="ttl_ayah" placeholder="Blitar, 04 Desember 2000"
                                                    value="{{ $data->ttl_ayah }}" disabled />
                                                <label>No Telephone Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="phone_ayah" placeholder="6565..."
                                                    value="{{ $data->phone_ayah }}" disabled />
                                                <label>Status Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="status_ayah" placeholder="6565..."
                                                    value="{{ $data->status_ayah }}" disabled />
                                                <label>Pendidikan Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pendidikan_ayah" placeholder="SMP"
                                                    value="{{ $data->pendidikan_ayah }}" disabled />
                                                <label>Pekerjaan Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pekerjaan_ayah" placeholder="Petani"
                                                    value="{{ $data->pekerjaan_ayah }}" disabled />
                                                <label>Penghasilan Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="integer"
                                                    name="penghasilan_ayah" placeholder="500000"
                                                    value="{{ $data->penghasilan_ayah }}" disabled />
                                                <label>Alamat Ayah</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="alamat_ayah" placeholder="Desa ....."
                                                    value="{{ $data->alamat_ayah }}" disabled />
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
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
                                            </div>
                                        </div>
                                        <div class="row text-start">
                                            <div class="col-12 col-sm-4">
                                            </div>
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                <label>Nama Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nama_ibu" placeholder="Eg. Michael"
                                                    value="{{ $data->nama_ibu }}" disabled />
                                                <label>NIK Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nik_ibu" placeholder="657.." value="{{ $data->nik_ibu }}"
                                                    disabled />
                                                <label>Tempat Tanggal Lahir Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="ttl_ibu" placeholder="Blitar, 04 Desember 2000"
                                                    value="{{ $data->ttl_ibu }}" disabled />
                                                <label>No Telephone Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="phone_ibu" placeholder="6565..." value="{{ $data->phone_ibu }}"
                                                    disabled />
                                                <label>Status Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="status_ibu" placeholder="6565..."
                                                    value="{{ $data->status_ibu }}" disabled />
                                                <label>Pendidikan Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pendidikan_ibu" placeholder="SMP"
                                                    value="{{ $data->pendidikan_ibu }}" disabled />
                                                <label>Pekerjaan Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pekerjaan_ibu" placeholder="Petani"
                                                    value="{{ $data->pekerjaan_ibu }}" disabled />
                                                <label>Penghasilan Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="integer"
                                                    name="penghasilan_ibu" placeholder="500000"
                                                    value="{{ $data->penghasilan_ibu }}" disabled />
                                                <label>Alamat Ibu</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="alamat_ibu" placeholder="Desa ....."
                                                    value="{{ $data->alamat_ibu }}" disabled />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Sebelumnya">Sebelumnya</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                    title="Selanjutnya">Selanjutnya</button>
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
                                                <a href="{{ url()->previous() }}"
                                                    class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                    title="Kembali">Kembali</a>
                                            </div>
                                        </div>
                                        <div class="row text-start">
                                            <div class="col-12 col-sm-4">
                                            </div>
                                            <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                <label>Nama Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nama_wali" placeholder="Eg. Michael"
                                                    value="{{ $data->nama_wali }}" disabled />
                                                <label>NIK Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="nik_wali" placeholder="657.." value="{{ $data->nik_wali }}"
                                                    disabled />
                                                <label>Tempat Tanggal Lahir Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="ttl_wali" placeholder="Blitar, 04 Desember 2000"
                                                    value="{{ $data->ttl_wali }}" disabled />
                                                <label>No Telephone Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="phone_wali" placeholder="6565..."
                                                    value="{{ $data->phone_wali }}" disabled />
                                                <label>Status Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="status_wali" placeholder="6565..."
                                                    value="{{ $data->status_wali }}" disabled />
                                                <label>Pendidikan Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pendidikan_wali" placeholder="SMP"
                                                    value="{{ $data->pendidikan_wali }}" disabled />
                                                <label>Pekerjaan Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="pekerjaan_wali" placeholder="Petani"
                                                    value="{{ $data->pekerjaan_wali }}" disabled />
                                                <label>Penghasilan Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="integer"
                                                    name="penghasilan_wali" placeholder="500000"
                                                    value="{{ $data->penghasilan_wali }}" disabled />
                                                <label>Alamat Wali</label>
                                                <input class="multisteps-form__input form-control mb-3" type="text"
                                                    name="alamat_wali" placeholder="Desa ....."
                                                    value="{{ $data->alamat_wali }}" disabled />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Sebelumnya">Sebelumnya</button>
                                                <a href="{{ url()->previous() }}"
                                                    class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                    title="Kembali">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
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

        function deleteBanner(id) {
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
