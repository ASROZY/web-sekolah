@extends('templates.admin.index',['title'=>'Tambah Banner'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Banner</h6>
            {{-- <a href="{{ url('admin/banner/tambah') }}" class="btn btn-primary">Tambah Banner</a> --}}
        </div>
        <hr>
        <div class="card-body p-3">
            <form action="{{ url('admin/banner/tambah') }}" method="post" enctype="multipart/form-data">
                @csrf
                <img src="" class="col-4" id="imagePreview" alt="">
                <div class="form-group mb-3 py-3">
                    <label for="banner" class="form-label">Banner</label>
                    <input class="form-control @error('banner') is-invalid @enderror" type="file" name="banner"
                        onchange="preview(this);">
                </div>
                @error('banner')
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
                    <label for="exampleFormControlTextarea1">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3"></textarea>
                </div>
                @error('keterangan')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function preview(banner) {
            if (banner.files && banner.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(banner.files[0]);
            }
        }
    </script>
@endpush
