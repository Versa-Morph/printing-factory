@extends('layouts.app')

@section('content')
<style>
    .heading-card-text{
        font-weight: bold;
        color: white;
        margin-top: 10px;
    }
    .background-polimer{
        background: #776acf;
    }
</style>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Employee Salary</h4>

            <form class="form-data" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">

                        <h5>Personal Info</h5>
                        <hr>
                        <!-- Employee Selection -->
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select class="form-select" id="employee_id" name="employee_id" >
                                <option value="">Choose Employee</option>
                                @foreach ($employee as $emp)
                                    <option value="{{ $emp->id }}"
                                        {{ $employeeSalary->employee_id == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->first_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <input type="text" class="form-control" id="payment_method" name="payment_method" 
                                value="{{ $employeeSalary->payment_method }}">
                        </div>

                        <!-- Rekening Number -->
                        <div class="mb-3">
                            <label for="rekening_number" class="form-label">Rekening Number</label>
                            <input type="text" class="form-control" id="rekening_number" name="rekening_number" 
                                value="{{ $employeeSalary->rekening_number }}">
                        </div>

                        <!-- Working Days -->
                        <div class="mb-3">
                            <label for="working_days" class="form-label">Working Days</label>
                            <input type="number" class="form-control" id="working_days" name="working_days" 
                                value="{{ $employeeSalary->working_days }}">
                        </div>

{{-- 
                        <h5>Overtime</h5>
                        <hr>
                        <!-- Overtime Per Hour -->
                        <div class="mb-3">
                            <label for="overtime_per_hour" class="form-label">Overtime Per Hour</label>
                            <input type="number" step="0.01" class="form-control" id="overtime_per_hour"
                                name="overtime_per_hour" value="{{ $employeeSalary->overtime_per_hour }}">
                        </div>

                        <!-- Additional Overtime -->
                        <div class="mb-3">
                            <label for="additional_overtime" class="form-label">Additional Overtime</label>
                            <input type="number" step="0.01" class="form-control" id="additional_overtime"
                                name="additional_overtime" value="{{ $employeeSalary->additional_overtime }}">
                        </div> --}}

                        <h5>Income</h5>
                        <hr>

                        <!-- Basic Salary -->
                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Basic Salary</label>
                            <input type="number" step="0.01" class="form-control" id="basic_salary" name="basic_salary"
                                 value="{{ $employeeSalary->basic_salary }}">
                        </div>

                        <!-- Transportation Incentive -->
                        <div class="mb-3">
                            <label for="transportation_incentive" class="form-label">Transportation Incentive</label>
                            <input type="number" step="0.01" class="form-control" id="transportation_incentive"
                                name="transportation_incentive" value="{{ $employeeSalary->transportation_incentive }}">
                        </div>

                        <!-- Daily Incentive -->
                        <div class="mb-3">
                            <label for="daily_incentive" class="form-label">Daily Incentive</label>
                            <input type="number" step="0.01" class="form-control" id="daily_incentive"
                                name="daily_incentive" value="{{ $employeeSalary->daily_incentive }}">
                        </div>

                        <!-- Position Incentive -->
                        <div class="mb-3">
                            <label for="position_incentive" class="form-label">Position Incentive</label>
                            <input type="number" step="0.01" class="form-control" id="position_incentive"
                                name="position_incentive" value="{{ $employeeSalary->position_incentive }}">
                        </div>


                    </div>
                    <div class="col-lg-6">

                        <h5>BPJS Kesehatan</h5>
                        <hr>
                        <!-- BPJS Kesehatan Base -->
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_base" class="form-label">BPJS Kesehatan Base</label>
                            <input type="number" step="0.01" class="form-control" id="bpjs_kesehatan_base"
                                name="bpjs_kesehatan_base" value="{{ $employeeSalary->bpjs_kesehatan_base }}">
                        </div>

                        <!-- BPJS Kesehatan Employee -->
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_employee" class="form-label">BPJS Kesehatan Employee (%)</label>
                            <input type="number" class="form-control" id="bpjs_kesehatan_employee"
                                name="bpjs_kesehatan_employee" value="{{ $employeeSalary->bpjs_kesehatan_employee }}">
                        </div>

                        <!-- BPJS Kesehatan Employer -->
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_employer" class="form-label">BPJS Kesehatan Employer (%)</label>
                            <input type="number" class="form-control" id="bpjs_kesehatan_employer"
                                name="bpjs_kesehatan_employer" value="{{ $employeeSalary->bpjs_kesehatan_employer }}">
                        </div>

                        <h5>BPJS Ketenagakerjaan</h5>
                        <hr>
                        <!-- BPJS Ketenagakerjaan Base -->
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_base" class="form-label">BPJS Ketenagakerjaan Base</label>
                            <input type="number" step="0.01" class="form-control" id="bpjs_ketenagakerjaan_base"
                                name="bpjs_ketenagakerjaan_base" value="{{ $employeeSalary->bpjs_ketenagakerjaan_base }}">
                        </div>

                        <!-- BPJS Ketenagakerjaan Employee -->
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_employee" class="form-label">BPJS Ketenagakerjaan Employee
                                (%)</label>
                            <input type="number" class="form-control" id="bpjs_ketenagakerjaan_employee"
                                name="bpjs_ketenagakerjaan_employee" value="{{ $employeeSalary->bpjs_ketenagakerjaan_employee }}">
                        </div>

                        <!-- BPJS Ketenagakerjaan Employer -->
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_employer" class="form-label">BPJS Ketenagakerjaan Employer
                                (%)</label>
                            <input type="number" class="form-control" id="bpjs_ketenagakerjaan_employer"
                                name="bpjs_ketenagakerjaan_employer" value="{{ $employeeSalary->bpjs_ketenagakerjaan_employer }}">
                        </div>


                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div><!-- end card-body -->
    </div><!-- end card -->
@endsection
@section('script')
    <script>
        // Show loading message
        function showLoading(message) {
            // Implement your loading logic here
            console.log(message); // Placeholder
        }

        // Hide loading message
        function hideLoading() {
            // Implement your loading hide logic here
            console.log('Loading hidden'); // Placeholder
        }

        // Show error message under a specific selector
        function showError(message, selector) {
            const element = document.querySelector(selector);
            if (element) {
                const error = document.createElement('span');
                error.className = 'error-msg text-danger';
                error.textContent = message;
                element.parentNode.appendChild(error);
            } else {
                console.error(`Selector ${selector} not found.`);
            }
        }

        $(document).ajaxStart(function() {
            showLoading('Processing Request.....');
        }).ajaxStop(function() {
            hideLoading();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('msk');
                
                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                // Collect form data
                const employee_id = document.querySelector('select[name="employee_id"]').value.trim();
                const payment_method = document.querySelector('input[name="payment_method"]').value.trim();
                const rekening_number = document.querySelector('input[name="rekening_number"]').value
            .trim();
                const working_days = document.querySelector('input[name="working_days"]').value.trim();
                const basic_salary = document.querySelector('input[name="basic_salary"]').value.trim();

                // Other fields
                // const overtime_per_hour = document.querySelector('input[name="overtime_per_hour"]').value
                //     .trim();
                // const additional_overtime = document.querySelector('input[name="additional_overtime"]')
                //     .value.trim();
                const transportation_incentive = document.querySelector(
                    'input[name="transportation_incentive"]').value.trim();
                const daily_incentive = document.querySelector('input[name="daily_incentive"]').value
            .trim();
                const position_incentive = document.querySelector('input[name="position_incentive"]').value
                    .trim();
                const bpjs_kesehatan_base = document.querySelector('input[name="bpjs_kesehatan_base"]')
                    .value.trim();
                const bpjs_kesehatan_employee = document.querySelector(
                    'input[name="bpjs_kesehatan_employee"]').value.trim();
                const bpjs_kesehatan_employer = document.querySelector(
                    'input[name="bpjs_kesehatan_employer"]').value.trim();
                const bpjs_ketenagakerjaan_base = document.querySelector(
                    'input[name="bpjs_ketenagakerjaan_base"]').value.trim();
                const bpjs_ketenagakerjaan_employee = document.querySelector(
                    'input[name="bpjs_ketenagakerjaan_employee"]').value.trim();
                const bpjs_ketenagakerjaan_employer = document.querySelector(
                    'input[name="bpjs_ketenagakerjaan_employer"]').value.trim();

                // Validation
                let hasError = false;
                if (!employee_id) {
                    showError('Please select an employee', '#employee_id');
                    hasError = true;
                }
                if (!payment_method) {
                    showError('Payment method is required', '#payment_method');
                    hasError = true;
                }
                if (!rekening_number) {
                    showError('Rekening number is required', '#rekening_number');
                    hasError = true;
                }
                if (!working_days) {
                    showError('Working days are required', '#working_days');
                    hasError = true;
                }
                if (!basic_salary) {
                    showError('Basic salary is required', '#basic_salary');
                    hasError = true;
                }
                if (isNaN(working_days) || working_days <= 0) {
                    showError('Working days must be a positive number', '#working_days');
                    hasError = true;
                }

                if (hasError) {
                    return;
                }

                // Form data object
                const formData = new FormData();
                formData.append('employee_id', employee_id);
                formData.append('payment_method', payment_method);
                formData.append('rekening_number', rekening_number);
                formData.append('working_days', working_days);
                formData.append('basic_salary', basic_salary);
                // formData.append('overtime_per_hour', overtime_per_hour);
                // formData.append('additional_overtime', additional_overtime);
                formData.append('transportation_incentive', transportation_incentive);
                formData.append('daily_incentive', daily_incentive);
                formData.append('position_incentive', position_incentive);
                formData.append('bpjs_kesehatan_base', bpjs_kesehatan_base);
                formData.append('bpjs_kesehatan_employee', bpjs_kesehatan_employee);
                formData.append('bpjs_kesehatan_employer', bpjs_kesehatan_employer);
                formData.append('bpjs_ketenagakerjaan_base', bpjs_ketenagakerjaan_base);
                formData.append('bpjs_ketenagakerjaan_employee', bpjs_ketenagakerjaan_employee);
                formData.append('bpjs_ketenagakerjaan_employer', bpjs_ketenagakerjaan_employer);

                console.log(formData);

                // Submit form via AJAX
                $.ajax({
                    url: '{{ route('employee-salary-update',$employeeSalary->id) }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alertSuccess(response.msg);
                            window.location.href = '{{ route('employee-salary-list') }}';
                        } else {
                            console.log(response.msg);
                            console.log(response.error);
                            alertFailed(response.msg);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
