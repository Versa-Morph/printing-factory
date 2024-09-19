@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4 class="box-title text-info mb-0"><i class="mdi mdi-account me-15"></i> Employee Information</h4>
                    <hr class="my-15">

                    <div>
                        <p class="mb-10"><span class="text-bold">Name :</span><span class="text-gray ps-10">{{ $work_schedule->employee->employee_code }}</span> </p>
                        <p class="mb-10"><span class="text-bold">Username :</span><span class="text-gray ps-10">{{ $work_schedule->employee->first_name }}</span> </p>
                        <p class="mb-10"><span class="text-bold">Nip :</span><span class="text-gray ps-10">{{ $work_schedule->employee->ktp_number }}</span></p>
                        {{-- <p class="mb-10"><span class="text-bold">Company :</span><span class="text-gray ps-10">{{ $work_schedule->employee->company->name }}</span> </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Date</label>
                                <input type="text" disabled class="form-control" value="{{ $work_schedule->date }}" name="date" placeholder="Ex:..">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-6">
                            <div class="mb-3"style="text-align: left">
                                <label class="form-label">Shift</label>
                                <select class="form-select form-select-sm mr-sm-2 @error('shift_id') is-invalid @enderror" id="shift_id" name="shift_id" style="width:100%">
                                    <option disabled selected>Choose Shift</option>
                                    @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"
                                        {{ old('shift_id', $work_schedule->shift_id) == $shift->id ? 'selected' : '' }}>
                                        {{ $shift->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div><!-- end row -->
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
                        url: '{{ route('hr-work-schedule-update',$work_schedule->id) }}',
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
