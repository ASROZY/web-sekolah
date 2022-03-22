@extends('templates.admin.index',['title'=>'Pendaftar'])
@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Semua Pendaftar</h6>
            {{-- <a href="{{ url('admin/pengurus/tambah') }}" class="btn btn-primary">Tambah Pendaftar</a> --}}
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email/Phone</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftar as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $item->email }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $item->phone }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($item->created_at)->format('D-M-Y') }}</span>
                                </td>
                                <td>
                                    @if (isset($item->ppdb))
                                        @if ($item->ppdb->status == 0)
                                            <span class="badge badge-sm bg-gradient-warning">Proses</span>
                                        @elseif ($item->ppdb->status == 2)
                                            <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                        @elseif ($item->ppdb->status == 1)
                                            <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                        @endif
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">Belum Daftar</span>
                                    @endisset
                            </td>
                            <td class="align-middle">
                                @if ($item->ppdb)
                                    <a href="{{ url('ppdb/' . $item->id . '/detail') }}"
                                        class="btn btn-sm btn-primary" data-toggle="tooltip"
                                        data-original-title="Detail Data">
                                        Detail Data
                                    </a>
                                    @if ($item->ppdb->status == 0)
                                        <button class="btn btn-sm btn-secondary"
                                            onclick="statusPpdb({{ $item->id }})">
                                            Status
                                        </button>
                                    @endif
                                @endif
                                <button class="btn btn-sm btn-danger" onclick="deletePpdb({{ $item->id }})">
                                    Hapus Data
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Pendaftar masih kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $pendaftar->links() }}
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

    function statusPpdb(id) {
        Swal.fire({
            title: 'Konfirmasi status PPDB Online',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Terima',
            denyButtonText: 'Tolak',
            cancelButtonText: 'Batal',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url('ppdb/status') }}',
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status: 1
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
                $.ajax({
                    url: '{{ url('ppdb/status') }}',
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        status: 2
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
        });
    }

    function deletePpdb(id) {
        Swal.fire({
            title: 'Apa kamu yakin menghapusnya?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url('ppdb/delete') }}',
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
