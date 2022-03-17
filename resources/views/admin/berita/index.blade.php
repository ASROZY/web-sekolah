@extends('templates.admin.index',['title'=>'Berita'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Semua Berita</h6>
            <a href="{{ url('admin/berita/tambah') }}" class="btn btn-primary">Tambah Berita</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Berita</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Penulis
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Tanggal
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset($item->thumbnail) }}" class="avatar avatar-sm me-3"
                                                alt="{{ $item->slug }}">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->judul }}</p>
                                            <p class="text-xs text-secondary mb-0">{!! mb_strimwidth($item->keterangan, 0, 60, '.....') !!}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{-- @if ($item->status == 0)
                                <span class="badge badge-sm bg-gradient-warning">Non-Aktif</span>
                            @else
                                <span class="badge badge-sm bg-gradient-success">Aktif</span>
                            @endif --}}
                                    {{ $item->penulis->name }}
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($item->created_at)->format('D-M-Y') }}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ url('admin/berita/' . $item->id . '/edit') }}"
                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                        data-original-title="Edit user">
                                        Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteBerita({{ $item->id }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Berita masih kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $berita->links() }}
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

        function deleteBerita(id) {
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
                        url: '{{ url('admin/berita/delete') }}',
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
