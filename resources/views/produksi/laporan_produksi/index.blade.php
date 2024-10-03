@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                    @can('create-order')
                        <div>
                            <a href="{{ route('laporan-produksi-create') }}" class="btn btn-light mb-4"><i class="mdi mdi-plus me-1"></i>
                                Tambah Laporan Produksi</a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="laporan-produksi-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Design Produk</th>
                            <th>Tanggal Produksi</th>
                            <th>Jumlah Produksi</th>
                            <th>Jumlah Reject</th>
                            <th>Tanggal Laporan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table><!-- end table -->
            </div>
        </div>
        <!-- end card body -->
    </div>
@endsection

@section('script')
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#laporan-produksi-table').DataTable({
                processing: false,

                serverSide: false,
                ajax: '{{ route('laporan-produksi-get-data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jadwal.rencana.desain.nama_desain',
                        name: 'jadwal.rencana.desain.nama_desain'
                    },
                    {
                        data: 'jadwal.tanggal_produksi',
                        name: 'jadwal.tanggal_produksi'
                    },
                    {
                        data: 'jumlah_produksi',
                        name: 'jumlah_produksi'
                    },
                    {
                        data: 'jumlah_reject',
                        name: 'jumlah_reject'
                    },
                    {
                        data: 'tanggal_laporan',
                        name: 'tanggal_laporan'
                    },
                    
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
               

            });

            // Delete action
            $(document).on('click', '.delete', function() {
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Yakin ingin hapus data ini?',
                    text: "Data yang sudah di hapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success'
                                    )
                                    $('#laporan-produksi-table').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.error,
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
