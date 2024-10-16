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
                    <a href="{{ route('quotation-create') }}" class="btn btn-light mb-4 bg-primary"><i class="mdi mdi-plus me-1"></i> Tambah Quotation</a>
                </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="quotation-table">
                <thead>
                    <tr class="bg-transparent">
                        <th>No</th>
                        <th>Quotation Number</th>
                        <th>Company Code</th>
                        <th>Product Type</th>
                        <th>Material Detail</th>
                        <th>Thickness</th>
                        <th>PO Number</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table><!-- end table -->
        </div>
    </div>
    <!-- end card body -->
</div>


<div id="modalContainer">
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Approve</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Order details will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#quotation-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: '{{ route('order-management-get-data') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'quotation_number', name: 'quotation_number' },
            { data: 'company_code', name: 'company_code' },
            { data: 'product_type', name: 'product_type' },
            { data: 'material_detail', name: 'material_detail' },
            { data: 'thickness', name: 'thickness' },
            { data: 'po_number', name: 'po_number' },
            {
                data: 'file',
                name: 'file',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    if (data) {
                        // Construct the file URL
                        return `<a href="{{ asset('assets/img/quotation') }}/${data}" target="_blank">${data}</a>`;
                    }
                    return ''; // Return empty if no file
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    // Event listener for opening modal
    $('#quotation-table').on('click', '.view-details', function() {
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
                            $('#quotation-table').DataTable().ajax.reload();
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