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
                @can('create-karyawan')
                <div>
                    <a href="{{ route('order-management-create') }}" class="btn btn-light mb-4 bg-primary"><i class="mdi mdi-plus me-1"></i> Tambah Order</a>
                </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="order-table">
                <thead>
                    <tr class="bg-transparent">
                        <th>No</th>
                        <th>Order Number</th>
                        <th>Quotation Number</th>
                        <th>PO Number</th>
                        <th>Company Code</th>
                        <th>Job No</th>
                        <th>Reduction</th>
                        <th>Position</th>
                        <th>Status Order</th>
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
    $('#order-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: '{{ route('order-management-get-data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'order_number', name: 'order_number' },
            { data: 'quotation_number', name: 'quotation_number' },
            { data: 'po_number', name: 'po_number' },
            { data: 'company_code', name: 'company_code' },
            { data: 'job_no', name: 'job_no' },
            { data: 'reduction', name: 'reduction' },
            { data: 'position', name: 'position' },
            { data: 'status_order', name: 'status_order' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    // Event listener for opening modal
    $('#order-table').on('click', '.view-details', function() {
        var orderId = $(this).data('id');
        $.ajax({
            url: '/quotation/modal-approve/' + orderId,
            method: 'GET',
            success: function(data) {
                $('#modalBody').html(data);
                $('#detailModal').modal('show');
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('There was an error fetching the details. Please try again later.');
            }
        });
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
                            $('#order-table').DataTable().ajax.reload();
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