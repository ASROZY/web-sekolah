@extends('templates.admin.index',['title'=>'Edit Pengurus'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Edit Pengurus</h6>
        </div>
        <hr>
        <div class="card-body p-3">
            <form action="{{ url('admin/pengurus/' . $pengurus->id . '/update') }}" method="post">
                @csrf
                <div class="form-group mb-3 py-3">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        value="{{ $pengurus->name }}">
                </div>
                @error('name')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $pengurus->email }}" placeholder="email">
                </div>
                @error('email')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group mb-3 py-3">
                    <label for="phone" class="form-label">No Telephone</label>
                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone"
                        value="{{ $pengurus->phone }}">
                </div>
                @error('phone')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="type" class="col">Type Akun</label>
                    <select class="form-control @error('type') is-invalid @enderror" name="type">
                        <option value="1" @if ($pengurus->type == 1) selected @endif>Guru</option>
                        <option value="2" @if ($pengurus->type == 2) selected @endif>Admin</option>
                    </select>
                </div>
                @error('type')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
                @enderror
                <div class="form-group mb-3 py-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
                </div>
                @error('password')
                    <div class="alert alert-danger text-white">{{ $message }}</div>
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
