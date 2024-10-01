@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="card br-20">
        <div class="card-body px-0">
            <div class="row align-items-start">
                <div class="col-sm d-flex justify-content-between align-items-center">
                    <div class="ms-3">
                        <h4 class="pb-0 mb-0">Employee List</h4>
                    </div>
                    @can('create-employe')
                    <div>
                        <a href="{{ route('employe-create') }}" class="btn btn-light me-3"><i class="mdi mdi-plus me-1"></i> Create Employe</a>
                    </div>
                    @endcan
                </div>
            </div>

            <hr>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="employe-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Employee Code</th>
                            <th>First Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
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
            $('#employe-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('employe-get-data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'employee_code', name: 'employee_code' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'address', name: 'address' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
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
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
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
                                $('#employe-table').DataTable().ajax.reload();
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
