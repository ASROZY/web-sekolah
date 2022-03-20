@extends('templates.admin.index',['title'=>'Galeri'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Semua Galeri</h6>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#albumModal">Tambah
                Album</button>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Album</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Status
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($album as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        @if ($item->foto->first())
                                            <div>
                                                <img src="{{ asset($item->foto->first()->img) }}"
                                                    class="avatar avatar-sm me-3" alt="{{ $item->foto->first()->img }}">
                                            </div>
                                        @endif
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="{{ url('admin/galeri/' . $item->id) }}"
                                                class="text-xs font-weight-bold mb-0">{{ $item->album }}</a>
                                            <p class="text-xs text-secondary mb-0">{{ $item->foto->count() }} Foto</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ($item->status == 0)
                                        <span class="badge badge-sm bg-gradient-warning"
                                            onclick="statusAlbum({{ $item->id }})">Tidak Tampil</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-success"
                                            onclick="statusAlbum({{ $item->id }})">Tampil</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($item->created_at)->format('D-M-Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url('admin/galeri/' . $item->id) }}"
                                        class="btn btn-sm btn-secondary">Detail</a>
                                    <button data-toggle="{{ $item->id }}" class="btn btn-sm btn-warning" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editAlbum{{ $item->id }}"
                                        data-original-title="Edit Album">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteAlbum({{ $item->id }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="editAlbum{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editAlbumModal{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAlbumModal{{ $item->id }}">Edit Album
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('admin/album/' . $item->id . '/update') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="album">Album</label>
                                                    <input type="text"
                                                        class="form-control @error('album') is-invalid @enderror"
                                                        name="album" placeholder="album" value="{{ $item->album }}">
                                                </div>
                                                @error('album')
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
                                    Album masih kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $album->links() }}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="albumModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="albumModalLabel">Tambah Album</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/album') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="album">Album</label>
                                <input type="text" class="form-control @error('album') is-invalid @enderror" id="album"
                                    name="album" placeholder="album">
                            </div>
                            @error('album')
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

        function statusAlbum(id) {
            $.ajax({
                url: '{{ url('admin/album/status') }}',
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
                }
            })
        }

        function deleteAlbum(id) {
            Swal.fire({
                title: 'Apa kamu yakin menghapusnya?',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('admin/album/delete') }}',
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
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Tidak jadi dihapus', '', 'info')
                }
            });
        }
    </script>
@endpush
