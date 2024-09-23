@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endpush

@section('header-info-content')
    
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row align-items-start">
            <div class="col-sm">
                @can('create-office-inventory')
                <div>
                    <a href="{{ route('office-inventory-create') }}" class="btn btn-light text-light mb-4 bg-primary"><i class="mdi mdi-plus me-1"></i> Tambah Office Inventory</a>
                </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="office-inventory-table">
                <thead>
                    <tr class="bg-transparent">
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Serial Number</th>
                        <th>Employee</th>
                        <th>Description</th>
                        <th>Purchase Date</th>
                        <th>Warranty Expiry</th>
                        <th>Condition</th>
                        <th>Assigned Date</th>
                        <th>Return Date</th>
                        <th>Location</th>
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
    $('#office-inventory-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: '{{ route('office-inventory-get-data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'item_name', name: 'item_name' }, // Clock out with badge
            { data: 'serial_number', name: 'serial_number' }, // Clock out with badge
            { data: 'employee', name: 'employee' }, // Clock out with badge
            { data: 'description', name: 'description' }, // Clock out with badge
            { data: 'purchase_date', name: 'purchase_date' }, // Clock out with badge
            { data: 'warranty_expiry', name: 'warranty_expiry' }, // Clock out with badge
            { data: 'condition', name: 'condition' }, // Clock out with badge
            { data: 'assigned_date', name: 'assigned_date' }, // Clock out with badge
            { data: 'return_date', name: 'return_date' }, // Clock out with badge
            { data: 'location', name: 'location' }, // Clock out with badge
            { data: 'action', name: 'action', orderable: false, searchable: false }
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
                            $('#office-inventory-table').DataTable().ajax.reload();
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