@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h4 class="card-title">{{ $page_title }}</h4>
        </div><!-- end card header -->
        <div class="card-body">
            <form class="form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3"style="text-align: left">
                            <label class="form-label">Employee</label>
                            <select class="form-select form-select-sm mr-sm-2 @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" style="width:100%">
                                <option disabled selected>Choose Employee</option>
                                @foreach ($employes as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id', $absence->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->employee_code }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Start Date</label>
                            <input type="date" class="form-control" value="{{ $absence->start_date }}" name="start_date" placeholder="Ex:..">
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">End Date</label>
                            <input type="date" class="form-control" value="{{ $absence->end_date }}" name="end_date" placeholder="Ex:..">
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="leave_type" class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="leave_type" name="leave_type">
                                <option value="">Select Status</option>
                                <option value="annual" {{ $absence->leave_type == 'annual' ? 'selected' : '' }}>Annual</option>
                                <option value="sick" {{ $absence->leave_type == 'sick' ? 'selected' : '' }}>Sick</option>
                                <option value="personal" {{ $absence->leave_type == 'personal' ? 'selected' : '' }}>Personal</option>
                                <option value="holiday" {{ $absence->leave_type == 'holiday' ? 'selected' : '' }}>Holiday</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="" name="status">
                                <option value="">Select Status</option>
                                <option value="pending" {{ $absence->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $absence->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $absence->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3">{{ $absence->reason }}</textarea>
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
                        url: '{{ route('absence-update',$absence->id) }}',
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
