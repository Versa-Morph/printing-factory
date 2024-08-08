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
                    <a href="{{ route('gaji-create') }}" class="btn btn-light mb-4"><i class="mdi mdi-plus me-1"></i>
                        Tambah Gaji</a>
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="gaji-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Jumlah Gaji</th>
                            <th>Tanggal Gaji</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#gaji-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: '{{ route('gaji-get-data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'karyawan.nama_karyawan',
                        name: 'karyawan.nama_karyawan'
                    },
                    {
                        data: 'jumlah_gaji',
                        name: 'jumlah_gaji',
                        render: function(data, type, row) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: 'tanggal_gaji',
                        name: 'tanggal_gaji'
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

            $(document).on('click', '.delete', function() {
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Yakin ingin hapus data ini?',
                    text: "Data yang sudah dihapus tidak dapat dikembalikan!",
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
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success'
                                    )
                                    $('#gaji-table').DataTable().ajax.reload();
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
                })
            });
        });
    </script>
@endsection
