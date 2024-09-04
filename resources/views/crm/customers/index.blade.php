@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="customer-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table><!-- end table -->
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer-get-data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'company_address', name: 'company_address' },
                    { data: 'company_phone_number', name: 'company_phone_number' },
                    { data: 'company_email', name: 'company_email' },
                    // { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

            // Delete action
            $(document).on('click', '.delete', function() {
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure you want to delete this data?',
                    text: "Deleted data cannot be returned!",
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
                                    $('#pelanggan-table').DataTable().ajax.reload();
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
    </script>
@endsection
