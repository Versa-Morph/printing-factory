@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                    @can('create-customer')
                        <div>
                            <a href="{{ route('customer-create') }}" class="btn btn-light mb-4"><i class="mdi mdi-plus me-1"></i>
                                Add Quotation
                            </a>
                            {{-- <a href="{{ route('form-customer') }}" class="btn btn-light mb-4">
                                <i class="mdi mdi-plus me-1"></i>
                                Open Form
                            </a> --}}
                        </div>
                    @endcan
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="customer-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No Quotation</th>
                            <th>Datetime</th>
                            <th>Code Company</th>
                            <th>Nama Company</th>
                            <th>Jenis Product</th>
                            <th>Material Detail</th>
                            <th>Thickness</th>
                            <th>Reduction</th>
                            <th>Position</th>
                            <th>Price</th>
                            <th>Remark</th>
                            <th>Term & Condition</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>QUO-001</td>
                            <td>10-10-2024 07:00:00</td>
                            <td>AKS</td>
                            <td>Cv Angkasa</td>
                            <td>Liquid Photopolymer Plate</td>
                            <td>Mf40</td>
                            <td>4MM</td>
                            <td>98%</td>
                            <td>Potrait</td>
                            <td>Rp. 2000.000</td>
                            <td>
                                <ul>
                                    <li>Remark 1</li>
                                    <li>Remark 2</li>
                                    <li>Remark 3</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>TC 1</li>
                                    <li>TC 2</li>
                                    <li>TC 3</li>
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-primary">Print preview</button>
                                <button class="btn btn-primary">Approve</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
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
            //     processing: true,
            //     serverSide: false,
            //     ajax: "{{ route('customer-get-data') }}",
            //     columns: [
            //         { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            //         { data: 'company_name', name: 'company_name' },
            //         { data: 'company_address', name: 'company_address' },
            //         { data: 'company_phone_number', name: 'company_phone_number' },
            //         { data: 'company_email', name: 'company_email' },
            //         { data: 'action', name: 'action', orderable: false, searchable: false }
            //     ]
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
