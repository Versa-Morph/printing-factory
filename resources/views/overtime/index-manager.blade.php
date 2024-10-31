@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .text-heading {
            font-weight: 700;
            margin-bottom: 2% !important;
        }

        .btn.dropdown-toggle {
            border-radius: 16px !important;
            border-color: transparent !important;
        }

        .badge-ontime {
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 16px;
            width: auto;
            font-weight: 700;
        }

        .badge-late {
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 16px;
            width: auto;
            font-weight: 700;
        }

        .badge-no-data {
            color: black;
            background: rgba(0, 0, 0, 0.1);
            padding: 16px;
            width: 62%;
            font-weight: 700;
        }

        .btn-create {
            background: rgba(79, 86, 211, 1);
            color: white;
            font-weight: 600;
            float: right
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="table-responsive mt-4 mt-sm-0">
                <h5 class="text-white mb-2 text-heading">Week 9 ( 26 February 2024 - 1 March 2024) </h5>
                <table class="table align-middle table-nowrap table-check" id="customer-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Approve By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overtime as $item)
                            <tr>
                                <td>
                                    <span>{{ $item->employee->first_name }}</span>
                                </td>
                                <td>
                                    <span>{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-ontime">{{ $item->start_time }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-ontime">{{ $item->end_time }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->subject }}</span>
                                </td>
                                <td>
                                    <span>{{ $item->description }}</span>
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge badge-late">Waiting Approve</span>
                                    @else
                                        <span class="badge badge-ontime">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <span>{{ $item->approve_by ?? '-' }}</span>
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <center>
                                            <div class='dropdown'>
                                                <button class='btn btn-light btn-sm dropdown-toggle' type='button'
                                                    data-bs-toggle='dropdown' aria-expanded='true'>
                                                    <i class='uil uil-ellipsis-h'></i>
                                                </button>
                                                <ul class='dropdown-menu dropdown-menu-end'>
                                                    @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Human Resource Manager') || Auth::user()->hasRole('Human Resource Staff'))
                                                        @if ($item->status == 1)
                                                            @if ($item->employee->id != getEmployeID())
                                                                <li><a class='dropdown-item approve' href="javascript:void(0);"
                                                                        data-url='{{ route('overtime-approve', $item->id) }}'>Approve</a>
                                                                </li>
                                                                <li><a class='dropdown-item delete' href='javascript:void(0);'
                                                                        data-url='{{ route('overtime-delete', $item->id) }}'>Delete</a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </center>
                                    @else
                                        <center>
                                            -
                                        </center>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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
            $('#customer-table').DataTable({});
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
                                window.location.href = '{{ route('overtime-manager-list') }}';
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

        $(document).on('click', '.approve', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure you want to approve this overtime data?',
                text: "Data that has been approved cannot be changed again!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Approve!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Approved Data Success!',
                                    response.success,
                                    'success'
                                )
                                window.location.href = '{{ route('overtime-manager-list') }}';
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
