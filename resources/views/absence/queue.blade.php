@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endsection

@section('header-info-content')
    
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="queue-table">
                <thead>
                    <tr class="bg-transparent">
                        <th>No</th>
                        <th>Employee</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Leave Type</th>
                        <th>Reason</th>
                        <th>Status</th>
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
    $('#queue-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: '{{ route('absence-get-data-queue') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'employee', name: 'employee' },
            { data: 'start_date', name: 'start_date' }, 
            { data: 'end_date', name: 'end_date' }, 
            { data: 'leave_type', name: 'leave_type' },
            { data: 'reason', name: 'reason' },
            { data: 'status', name: 'status' },
        ]
    });



    // Delete action
    $(document).on('click', '.delete', function () {
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
                    success: function (response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.success,
                                'success'
                            )
                            $('#absence-table').DataTable().ajax.reload();
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