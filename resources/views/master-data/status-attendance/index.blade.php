@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .table.dataTable.no-footer {
            width: 100% !important;
        }
    </style>
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-sm">
                    @can('create-status-attendance')
                        <div>
                            <a href="{{ route('status-attendance-create') }}" class="btn btn-light mb-4 bg-primary text-white"
                                style="float: right"><i class="mdi mdi-plus me-1"></i> Tambah Status Attendance</a>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="status-attendance-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Title</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Radius</th>
                            <th style="width: 10%" >Address</th>
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
            $('#status-attendance-table').DataTable({
                processing: false,
                serverSide: false,
                ajax: '{{ route('status-attendance-get-data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                   
                    {
                        data: 'latitude',
                        name: 'latitude'
                    },
                    {
                        data: 'longitude',
                        name: 'longitude'
                    },
                    {
                        data: 'radius',
                        name: 'radius'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
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
                                    $('#status-attendance-table').DataTable().ajax
                                        .reload();
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
