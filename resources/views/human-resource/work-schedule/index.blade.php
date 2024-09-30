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
                    <a href="{{ route('hr-work-schedule-create') }}" class="btn btn-light text-light mb-4 bg-primary"><i class="mdi mdi-plus me-1"></i> Tambah Work Schedule</a>
                </div>
                <div>
                    <form id="delete-form" method="POST" action="{{ route('hr-work-schedule-delete-checklist') }}">
                        @csrf
                        <button type="submit" class="btn btn-light text-light mb-4 bg-primary">
                            <i class="mdi mdi-plus me-1"></i> Delete Data
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>

        <div class="table-responsive mt-4 mt-sm-0">
            <table class="table align-middle table-nowrap table-check" id="work-schedule-table">
                <thead>
                    <tr class="bg-transparent">
                        <th>No</th>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Action</th>
                        <th>Checklist</th>
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
        $('#work-schedule-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ route('hr-work-schedule-get-data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date', name: 'date' },
                { data: 'shift', name: 'shift' },
                { data: 'clock_in', name: 'clock_in' },
                { data: 'clock_out', name: 'clock_out' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'employee_checklist', name: 'employee_checklist', orderable: false, searchable: false, render: function(data, type, row) {
                    return `
                        <div class="demo-checkbox">
                            <input name="employee[]" type="checkbox" value="${row.id}" 
                                class="filled-in" id="employee-${row.id}">
                            <label for="employee-${row.id}" style="height: 0px; min-width: 0;"></label>
                        </div>`;
                }}
            ]
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