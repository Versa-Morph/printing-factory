@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@endsection

@section('header-info-content')

@endsection
@section('content')
<div class="card br-20">
    <div class="card-body px-0">
        <div class="row align-items-start">
            <div class="col-sm d-flex justify-content-between align-items-center">
                <div class="ms-3">
                    <h4 class="pb-0 mb-0">Work Schedule</h4>
                    {{-- <h5 class="text-secondary">Week 9 ( 26 February 2024 - 1 March 2024)</h5> --}}
                </div>

                @can('create-karyawan')
                <div class="d-flex">
                    <form id="delete-form" method="POST" action="{{ route('hr-work-schedule-delete-checklist') }}">
                        @csrf
                        <button type="submit" class="btn btn-light text-light me-2 bg-danger">
                            Delete Data By Checklist
                        </button>
                    </form>
                    <a href="{{ route('hr-work-schedule-create') }}" class="btn btn-light me-3"><i class="mdi mdi-plus me-1"></i> Create Work Schedule</a>
                </div>
                @endcan
            </div>
        </div>

        <hr>
        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="work-schedule-table">
                <thead>
                    <tr class="bg-transparent">
                        <th width="3%">#</th>
                        <th>No</th>
                        <th>Date</th>
                        <th>Employee</th>
                        <th>Shift</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th width="10%">Action</th>
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
        var today = new Date().toISOString().split('T')[0];

        $('#work-schedule-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ route('hr-work-schedule-get-data') }}',
            columns: [
                { data: 'employee_checklist', name: 'employee_checklist', orderable: false, searchable: false, render: function(data, type, row) {
                    return `
                        <div class="demo-checkbox">
                            <input name="employee[]" type="checkbox" value="${row.id}"
                                class="filled-in" id="employee-${row.id}">
                            <label for="employee-${row.id}" style="height: 0px; min-width: 0;"></label>
                        </div>`;
                }},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date', name: 'date' },
                { data: 'employee_name', name: 'employee_name' },
                { data: 'shift', name: 'shift' },
                { data: 'clock_in', name: 'clock_in' },
                { data: 'clock_out', name: 'clock_out' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            rowCallback: function(row, data) {
                // Jika tanggal di data sama dengan hari ini
                if (data.date === today) {
                    // Tambahkan warna ke semua <td> dalam baris
                    $('td', row).each(function() {
                        $(this).addClass('highlight-today');
                    });
                }
            }
        });



    // Delete Checklist
    $('#delete-form').on('submit', function(e) {
        e.preventDefault();

        var selectedIds = [];
        $('input[name="employee[]"]:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one record to delete.");
            return;
        }

        $.ajax({
            url: '{{ route('hr-work-schedule-delete-checklist') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                employee_ids: selectedIds
            },
            success: function(response) {
                if (response.success) {
                    alert(response.success);
                    $('#work-schedule-table').DataTable().ajax.reload();
                } else {
                    alert(response.error);
                }
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
                            $('#work-schedule-table').DataTable().ajax.reload();
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
