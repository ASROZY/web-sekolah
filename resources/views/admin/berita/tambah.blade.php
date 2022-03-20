@extends('templates.admin.index',['title'=>'Tambah Berita'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Berita</h6>
            {{-- <a href="{{ url('admin/berita/tambah') }}" class="btn btn-primary">Tambah Berita</a> --}}
        </div>
        <hr>
        <div class="card-body p-3">
            <form action="{{ url('admin/berita/tambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <img src="" class="col-4" id="imagePreview" alt="">
                <div class="form-group mb-3 py-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail"
                        onchange="preview(this);">
                </div>
                @error('thumbnail')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                        placeholder="judul">
                </div>
                @error('judul')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div class="row">
                        <label for="kategori_id" class="col">Kategori</label>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm bg-gradient-primary col-auto" data-bs-toggle="modal"
                            data-bs-target="#kategoriModal">
                            Tambah Kategori
                        </button>
                    </div>

                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id"
                        name="kategori_id">
                        <option selected>Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kategori_id')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Berita</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="summernote" name="keterangan"
                        rows="3"></textarea>
                </div>
                @error('keterangan')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="kategoriModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('admin/kategori/tambah') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                        id="kategori" name="kategori" placeholder="Kategori">
                                </div>
                                @error('kategori')
                                    <div class="alert alert-danger text-white">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('summernote/summernote.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                tabsize: 2,
                focus: true
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

        function preview(foto) {
            if (foto.files && foto.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(foto.files[0]);
            }
        }
    </script>
@endpush
