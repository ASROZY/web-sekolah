@extends('templates.admin.index',['title'=>'Edit Banner'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Edit Banner</h6>
            {{-- <a href="{{ url('admin/banner/tambah') }}" class="btn btn-primary">Tambah Banner</a> --}}
        </div>
        <hr>
        <div class="card-body p-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('admin/banner/' . $banner->id . '/update') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3 px-3 row">
                    <label for="formFile" class="form-label">Banner</label>
                    <img src="{{ $banner->img }}" class="col-4" alt="">
                    <input class="form-control @error('banner') is-invalid @enderror" type="file" name="banner">
                </div>
                @error('banner')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul"
                        value="{{ $banner->judul }}" placeholder="judul">
                </div>
                @error('judul')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror"
                        name="keterangan">{{ $banner->keterangan }}</textarea>
                </div>
                @error('keterangan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button class="btn btn-primary" type="submit">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('summernote/summernote.js') }}"></script>
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
    </script>
@endpush
