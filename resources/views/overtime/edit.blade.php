@extends('layouts.app')

@section('style')
@endsection

@section('header-info-content')
@endsection
@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ $page_title }}</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <form class="form-data">
                    <div class="row">

                        @if (Auth::user()->hasRole('Super Admin'))
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Employee</label>
                                    <select class="form-select" id="employee_id" name="employee_id" >
                                        <option value="">Choose Employee</option>
                                        @foreach ($employee as $emp)
                                            <option value="{{ $emp->id }}"
                                                {{ $overtime->employee_id == $emp->id ? 'selected' : '' }}>
                                                {{ $emp->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- end col -->
                        @endif

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Subject</label>
                                <input type="text" class="form-control" value="{{ $overtime->subject }}" name="subject" placeholder="Ex:Request Overtime..">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Date</label>
                                <input type="date" class="form-control" value="{{ $overtime->date }}" name="date" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Start Time</label>
                                <input type="time" class="form-control" value="{{ $overtime->start_time }}" name="start_time" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">End Time</label>
                                <input type="time" class="form-control" value="{{ $overtime->end_time }}" name="end_time" placeholder="Ex:">
                            </div>
                        </div><!-- end col -->

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="validationCustom01">Description</label>
                                <textarea name="description" class="form-control" placeholder="Ex:...">{{ $overtime->description }}</textarea>
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->

                    <a href="{{ route('overtime-list') }}" class="btn btn-danger" style="float: left">Kembali</a>
                    <button type="submit" class="btn btn-primary" style="float: right">Save</button>
                </form><!-- end form -->
            </div><!-- end card body -->
        </div>
    </div>
@endsection

@section('script')
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

                const date = document.querySelector('input[name="date"]').value.trim();
                const subject = document.querySelector('input[name="subject"]').value.trim();
                const startTime = document.querySelector('input[name="start_time"]').value.trim();
                const endTime = document.querySelector('input[name="end_time"]').value.trim();
                const description = document.querySelector('textarea[name="description"]').value.trim();
                let isValid = true;


                @if (Auth::user()->hasRole('Super Admin'))
                    const employee_id = document.querySelector('select[name="employee_id"]').value.trim();
                    if (!employee_id) {
                        showError('Employee cannot null', 'select[name="employee_id"]');
                        isValid = false;
                    }
                @endif
                if (!date) {
                    showError('Date cannot null', 'input[name="date"]');
                    isValid = false;
                }
                if (!subject) {
                    showError('Subject cannot null', 'input[name="subject"]');
                    isValid = false;
                }

                if (!startTime) {
                    showError('Start Time cannot null', 'input[name="start_time"]');
                    isValid = false;
                }

                if (!endTime) {
                    showError('End Time cannot null', 'input[name="end_time"]');
                    isValid = false;
                }
                if (!description) {
                    showError('Description cannot null', 'textarea[name="description"]');
                    isValid = false;
                }

                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('overtime-update',$overtime->id) }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);

                            if (response.success) {
                                alertSuccess(response.msg);
                                window.location.href = '{{ route('overtime-list') }}';
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
