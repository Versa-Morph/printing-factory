@extends('layouts.app')

@push('styles')
@endpush

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data" id="wo-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Start Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">End Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="end_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3"style="text-align: left">
                                <label class="form-label">Shift <small class="text-danger">*</small></label>
                                <select class="form-select mr-sm-2 @error('shift_id') is-invalid @enderror" id="shift_id" name="shift_id" style="width:100%">
                                    <option disabled selected>Choose Shift</option>
                                    @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"
                                        {{ old('shift_id') == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex flex-row justify-content-between mt-10">
                                <label class="form-label mt-5">Employee <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        
                    </div><!-- end row -->

                    <div class="row">
                        <div class="table-responsive mt-4 mt-sm-0">
                            <table class="table align-middle table-nowrap table-check" id="workingTable">
                                <thead>
                                    <tr class="bg-transparent">
                                        <th style="">No</th>
                                        <th style="">Name</th>
                                        <th style="">NIK</th>
                                        <th style="" class="text-center">Checklist</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employes as $employee)
                                    <tr class="row-employee">										
                                        <td class="text-start" style="max-width: 360px">
                                            <span class="text-dark ms-10">
                                                {{ $loop->iteration }}
                                            </span>
                                        </td>
                                        <td class="text-start" style="max-width: 360px">
                                            <span class="text-dark ms-10">
                                                {{ $employee->user->name }}
                                            </span>
                                        </td>
                                        <td class="text-start">
                                            <span class="text-dark ms-10">
                                                {{ $employee->ktp_number }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="demo-checkbox">
                                                <input name="employee[]" type="checkbox" value="{{$employee->id}}" {{ in_array($employee->id, old('employee') ?? []) ? 'checked' : '' }} class="filled-in">
                                                <label for="" style="height: 0px; min-width: 0;"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- end table -->
                        </div>
                    </div>

                    <a href="{{ route('hr-work-schedule-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
    $("#wo-form").on("submit", function() {
        $('#workingTable').DataTable().search('').draw();
        // return false;
    });

        $('.row-employee').click(function () {
            let data = $(this).find('input:checkbox');
            data.prop('checked', !data.is(':checked'));
        });

        $(function() {
            $('#workingTable').DataTable({
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                info: false,
            });
        })

        
</script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                let isValid = true;

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('hr-work-schedule-store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                alertSuccess(response.msg);
                                window.location.href = '{{ route('hr-work-schedule-list') }}';
                            } else {
                                alertFailed(response.msg);
                            }
                        },
                        error: function(xhr) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    showError(errors[key][0], `[name="${key}"]`);
                                }
                            }
                        }
                    });
                }
            });

            function showError(message, selector) {
                const element = document.querySelector(selector);
                const error = document.createElement('span');
                error.className = 'error-msg text-danger';
                error.textContent = message;
                element.parentNode.appendChild(error);
            }
        });
    </script>
@endsection
