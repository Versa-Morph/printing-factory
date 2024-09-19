@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .table-hover{
            border: snow !important;
        }
        
        .dataTables_scrollBody{
            border: none !important;

        }
    </style>
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
                            <div class="mb-3"style="text-align: left">
                                <label class="form-label">Emplopyee <small class="text-danger">*</small></label>
                                <select class="form-select mr-sm-2 @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" style="width:100%">
                                    <option disabled selected>Choose Employee</option>
                                    @foreach ($employes as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_code }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Start Date <small class="text-danger">*</small></label>
                                <input type="start_date" class="form-control" name="start_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">End Date <small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="end_date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="leave_type" class="form-label">Leave Type</label>
                                <select class="form-select" id="leave_type" name="leave_type">
                                    <option value="">Select Leave Type</option>
                                    <option value="annual" {{ old('leave_tyoe') == 'annual' ? 'selected' : '' }}>Annual</option>
                                    <option value="sick" {{ old('leave_tyoe') == 'sick' ? 'selected' : '' }}>Sick</option>
                                    <option value="personal" {{ old('leave_tyoe') == 'personal' ? 'selected' : '' }}>Personal</option>
                                    <option value="holiday" {{ old('leave_tyoe') == 'holiday' ? 'selected' : '' }}>Holiday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="" name="status">
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" id="reason" placeholder="Ex:......" name="reason" rows="3">{{ old('reason') }}</textarea>
                            </div>
                        </div>

                    </div><!-- end row -->

                    <a href="{{ route('absence-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
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
                        url: '{{ route('absence-store') }}',
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
                                window.location.href = '{{ route('absence-list') }}';
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
