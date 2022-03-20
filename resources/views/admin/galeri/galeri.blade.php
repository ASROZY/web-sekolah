@extends('templates.admin.index',['title'=>'Foto Pada Album '.$album->album])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Semua Foto Pada Album {{ $album->album }}</h6>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#galeriModal">Tambah
                galeri</button>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Foto
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeri as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <div>
                                        <img src="{{ asset($item->img) }}" class="avatar avatar-sm me-3"
                                            alt="{{ $item->img }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->judul }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->keterangan }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($item->created_at)->format('D-M-Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#galeriEditModal{{ $item->id }}" class="btn btn-sm btn-warning"
                                        data-toggle="tooltip" data-original-title="Edit">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteGaleri({{ $item->id }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="galeriEditModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="galeriEditModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="galeriEditModalLabel">Tambah Galeri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('admin/galeri/' . $item->id . '/update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <img src="{{ asset($item->img) }}" class="col-4"
                                                    id="imagePreviewEdit{{ $item->id }}" alt="{{ $item->img }}">
                                                <div class="form-group">
                                                    <label for="foto">Galeri</label>
                                                    <input type="file"
                                                        class="form-control @error('foto') is-invalid @enderror" name="foto"
                                                        placeholder="foto.jpg"
                                                        onchange="previewEdit(this,{{ $item->id }});">
                                                </div>
                                                @error('foto')
                                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="keterangan">Galeri</label>
                                                    <input type="text"
                                                        class="form-control @error('keterangan') is-invalid @enderror"
                                                        id="keterangan" name="keterangan" placeholder="keterangan"
                                                        value="{{ $item->keterangan }}">
                                                </div>
                                                @error('keterangan')
                                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Galeri foto masih kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $galeri->links() }}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="galeriModal" tabindex="-1" role="dialog" aria-labelledby="galeriModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galeriModalLabel">Tambah Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/galeri/' . $album->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img src="" class="col-4" id="imagePreview" alt="">
                        <div class="modal-body">
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <div class="form-group">
                                <label for="foto">Galeri</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                    name="foto" placeholder="foto.jpg" onchange="preview(this);">
                            </div>
                            @error('foto')
                                <div class="alert alert-danger text-white">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="keterangan">Galeri</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                    id="keterangan" name="keterangan" placeholder="keterangan">
                            </div>
                            @error('keterangan')
                                <div class="alert alert-danger text-white">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://demos.creative-tim.com/argon-design-system-pro/assets/demo/vendor/holder.min.js"
        type="text/javascript"></script>
    <script src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/js/plugins/moment.min.js"
        type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

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

        function preview(galeri) {
            if (galeri.files && galeri.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreviewEdit').attr('src', e.target.result);
                };
                reader.readAsDataURL(galeri.files[0]);
            }
        }

        function previewEdit(galeri, id) {
            if (galeri.files && galeri.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreviewEdit' + id).attr('src', e.target.result);
                };
                reader.readAsDataURL(galeri.files[0]);
            }
        }

        function deleteGaleri(id) {
            Swal.fire({
                title: 'Apa kamu yakin menghapusnya?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('admin/galeri/delete') }}',
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire(res.message, '', 'success');
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
