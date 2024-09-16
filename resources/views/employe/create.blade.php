@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Employee</h4>

            <form class="form-data" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- User Selection -->
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select User</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">Choose User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Employee Code -->
                        <div class="mb-3">
                            <label for="employee_code" class="form-label">Employee Code</label>
                            <input type="text" class="form-control" id="employee_code" name="employee_code"
                                value="{{ old('employee_code') }}">
                        </div>

                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ old('first_name') }}">
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ old('last_name') }}">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone') }}">
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth') }}">
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                        </div>

                        <!-- Hire Date -->
                        <div class="mb-3">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date"
                                value="{{ old('hire_date') }}">
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>

                        <!-- Status Attendance -->
                        <div class="mb-3">
                            <label for="status-empoye" class="form-label">Status Employee</label>
                            <select class="form-select" id="status_employe" name="status_employe">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="terminated" {{ old('status') == 'terminated' ? 'selected' : '' }}>
                                    Terminated</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <!-- KTP Number -->
                        <div class="mb-3">
                            <label for="ktp_number" class="form-label">KTP Number</label>
                            <input type="text" class="form-control" id="ktp_number" name="ktp_number"
                                value="{{ old('ktp_number') }}">
                        </div>

                        <!-- KTP File -->
                        <div class="mb-3">
                            <label for="ktp_file" class="form-label">KTP File</label>
                            <input type="file" class="form-control" id="ktp_file" name="ktp_file">
                        </div>

                        <!-- NPWP Number -->
                        <div class="mb-3">
                            <label for="npwp_number" class="form-label">NPWP Number</label>
                            <input type="text" class="form-control" id="npwp_number" name="npwp_number"
                                value="{{ old('npwp_number') }}">
                        </div>

                        <!-- NPWP File -->
                        <div class="mb-3">
                            <label for="npwp_file" class="form-label">NPWP File</label>
                            <input type="file" class="form-control" id="npwp_file" name="npwp_file">
                        </div>

                        <!-- BPJS Kesehatan Number -->
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_number" class="form-label">BPJS Kesehatan Number</label>
                            <input type="text" class="form-control" id="bpjs_kesehatan_number"
                                name="bpjs_kesehatan_number" value="{{ old('bpjs_kesehatan_number') }}">
                        </div>

                        <!-- BPJS Kesehatan File -->
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_file" class="form-label">BPJS Kesehatan File</label>
                            <input type="file" class="form-control" id="bpjs_kesehatan_file"
                                name="bpjs_kesehatan_file">
                        </div>

                        <!-- BPJS Ketenagakerjaan Number -->
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_number" class="form-label">BPJS Ketenagakerjaan
                                Number</label>
                            <input type="text" class="form-control" id="bpjs_ketenagakerjaan_number"
                                name="bpjs_ketenagakerjaan_number" value="{{ old('bpjs_ketenagakerjaan_number') }}">
                        </div>

                        <!-- BPJS Ketenagakerjaan File -->
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_file" class="form-label">BPJS Ketenagakerjaan File</label>
                            <input type="file" class="form-control" id="bpjs_ketenagakerjaan_file"
                                name="bpjs_ketenagakerjaan_file">
                        </div>

                        <!-- Family Card Number -->
                        <div class="mb-3">
                            <label for="family_card_number" class="form-label">Family Card Number</label>
                            <input type="text" class="form-control" id="family_card_number" name="family_card_number"
                                value="{{ old('family_card_number') }}">
                        </div>

                        <!-- Family Card File -->
                        <div class="mb-3">
                            <label for="family_card_file" class="form-label">Family Card File</label>
                            <input type="file" class="form-control" id="family_card_file" name="family_card_file">
                        </div>

                        <!-- Marital Status -->
                        <div class="mb-3">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <input type="text" class="form-control" id="marital_status" name="marital_status"
                                value="{{ old('marital_status') }}">
                        </div>

                        <!-- Status Attendance -->
                        <div class="mb-3">
                            <label for="status_attendance" class="form-label">Status Attendance</label>
                            <select class="form-select" id="status_attendance" name="status_attendance">
                                <option value="">Select Attendance Status</option>
                                <option value="mobile" {{ old('status_attendance') == 'mobile' ? 'selected' : '' }}>Mobile
                                </option>
                                <option value="office" {{ old('status_attendance') == 'office' ? 'selected' : '' }}>Office
                                </option>
                            </select>
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
    $(document).ajaxStart(function() {
        showLoading('Processing Request.....');
    }).ajaxStop(function() {
        hideLoading();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.form-data');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous validation messages
            const errorElements = document.querySelectorAll('.error-msg');
            errorElements.forEach(function(element) {
                element.remove();
            });

            // Collect form data
            const user_id = document.querySelector('select[name="user_id"]').value.trim();
            const employee_code = document.querySelector('input[name="employee_code"]').value.trim();
            const first_name = document.querySelector('input[name="first_name"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const hire_date = document.querySelector('input[name="hire_date"]').value.trim();
            const status_employe = document.querySelector('select[name="status_employe"]').value.trim();

            let isValid = true;

            // Validation
            if (!user_id) {
                showError('User cannot be null', 'select[name="user_id"]');
                isValid = false;
            }
            if (!employee_code) {
                showError('Employee Code cannot be null', 'input[name="employee_code"]');
                isValid = false;
            }
            if (!first_name) {
                showError('First Name cannot be null', 'input[name="first_name"]');
                isValid = false;
            }
            if (!email) {
                showError('Email cannot be null', 'input[name="email"]');
                isValid = false;
            }
            if (!hire_date) {
                showError('Hire Date cannot be null', 'input[name="hire_date"]');
                isValid = false;
            }
            if (!status_employe) {
                showError('Hire Date cannot be null', 'select[name="status_employe"]');
                isValid = false;
            }
            
             // File Validation
            const validFileTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            const maxFileSize = 2 * 1024 * 1024; // 2MB

            const fileInputs = form.querySelectorAll('input[type="file"]');
            let validFiles = true;

            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    Array.from(input.files).forEach(file => {
                        if (!validFileTypes.includes(file.type) || file.size > maxFileSize) {
                            validFiles = false;
                            // Handle invalid file
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid File',
                                text: `File ${file.name} is not valid.`
                            });
                        }
                    });
                }
            });

            if (!validFiles) {
                return;
            }
            console.log(isValid);

            // Submit form if valid
            if (isValid) {
                const formData = new FormData(form);
                
                $.ajax({
                    url: '{{ route('employe-store') }}',
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
                            window.location.href = '{{ route('employe-list') }}';
                        } else {
                            console.log(response.msg);
                            
                            alertFailed(response.msg);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON); // Debugging
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
            if (element) {
                const error = document.createElement('span');
                error.className = 'error-msg text-danger';
                error.textContent = message;
                element.parentNode.appendChild(error);
            } else {
                console.error(`Selector ${selector} not found.`);
            }
        }

        function showLoading(message) {
            // Implement your loading logic here
            console.log(message); // Placeholder
        }

        function hideLoading() {
            // Implement your loading hide logic here
            console.log('Loading hidden'); // Placeholder
        }

    });
</script>
@endsection