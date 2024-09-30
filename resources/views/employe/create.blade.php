@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Employee</h4>

            <form class="form-data" enctype="multipart/form-data">
                <div class="row">
                    <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Employee Information</h4>
                    <hr class="my-15">
                    <div class="col-lg-4">
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" placeholder="Ex:David" name="first_name" value="{{ old('first_name') }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Ex:admin@gmail.com" id="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                        
                    <div class="col-lg-4">
                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Ex:david" id="last_name" name="last_name" value="{{ old('last_name') }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Employee Code -->
                        <div class="mb-3">
                            <label for="employee_code" class="form-label">Employee Code <span class="text-danger">*</span></label></label>
                            <input type="text" class="form-control" placeholder="Ex:EMP 01" id="employee_code" name="employee_code" value="{{ old('employee_code') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" placeholder="Ex:08xxxxxxxxx" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" placeholder="********" id="password" name="password">
                        </div>
                    </div>

                    <!-- Hire Date -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="hire_date" class="form-label" >Hire Date <span class="text-danger">*</span></label></label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date"
                                value="{{ old('hire_date') }}">
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="********" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    
                    <!-- Marital Status -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <input type="text" class="form-control" placeholder="Ex:Single/Married" id="marital_status" name="marital_status" value="{{ old('marital_status') }}">
                        </div>
                    </div>

                    <!-- Status Attendance -->
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label for="status-empoye" class="form-label">Status Employee <span class="text-danger">*</span></label></label>
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

                    <!-- Date of Birth -->
                    <div class="col-lg-2">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" placeholder="Ex: Jakarta" name="address" rows="3">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="roles" class="form-label">Roles <span class="text-danger">*</span></label>
                            <select name = "roles" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                @forelse ($roles as $role)

                                    @if ($role!='Super Admin')
                                        <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                        {{ $role }}
                                        </option>
                                    @else
                                        @if (Auth::user()->hasRole('Super Admin'))
                                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role }}
                                            </option>
                                        @endif
                                    @endif

                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        </div>
                    </div>

                    <!-- Status Attendance -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="status_attendance" class="form-label">Status Attendance <span class="text-danger">*</span></label></label>
                            <select class="form-select" id="status_attendance" name="status_attendance">
                                <option value="">Select Attendance Status</option>
                                @foreach ($statusAttendance as $sa)
                                    <option value="{{ $sa->id }}" {{ old('status_attendance') == $sa->id ? 'selected' : '' }}>{{ $sa->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <h4 class="box-title text-info mb-0 mt-4"><i class="ti-user me-15"></i> Data Information</h4>
                    <hr class="my-15">

                    <!-- KTP Number -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="ktp_number" class="form-label">KTP Number</label>
                            <input type="text" class="form-control" placeholder="Ex:320xxxxx" id="ktp_number" name="ktp_number" value="{{ old('ktp_number') }}">
                        </div>
                    </div>

                    <!-- KTP File -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="ktp_file" class="form-label">KTP File</label>
                            <input type="file" class="form-control" id="ktp_file" name="ktp_file">
                        </div>
                    </div>

                    <!-- NPWP Number -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="npwp_number" class="form-label">NPWP Number</label>
                            <input type="text" class="form-control" placeholder="54xxxxx" id="npwp_number" name="npwp_number" value="{{ old('npwp_number') }}">
                        </div>
                    </div>

                    <!-- NPWP File -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="npwp_file" class="form-label">NPWP File</label>
                            <input type="file" class="form-control" id="npwp_file" name="npwp_file">
                        </div>
                    </div>

                    <!-- BPJS Kesehatan Number -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_number" class="form-label">BPJS Kesehatan Number</label>
                            <input type="text" class="form-control" placeholder="Ex:32xxxxxxx" id="bpjs_kesehatan_number" name="bpjs_kesehatan_number" value="{{ old('bpjs_kesehatan_number') }}">
                        </div>
                    </div>

                    <!-- BPJS Kesehatan File -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="bpjs_kesehatan_file" class="form-label">BPJS Kesehatan File</label>
                            <input type="file" class="form-control" id="bpjs_kesehatan_file" name="bpjs_kesehatan_file">
                        </div>
                    </div>

                    <!-- BPJS Ketenagakerjaan Number -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_number" class="form-label">BPJS Ketenagakerjaan Number</label>
                            <input type="text" class="form-control" id="bpjs_ketenagakerjaan_number" placeholder="Ex:32xxxxxxx" name="bpjs_ketenagakerjaan_number" value="{{ old('bpjs_ketenagakerjaan_number') }}">
                        </div>
                    </div>

                    <!-- BPJS Ketenagakerjaan File -->
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="bpjs_ketenagakerjaan_file" class="form-label">BPJS Ketenagakerjaan File</label>
                            <input type="file" class="form-control" id="bpjs_ketenagakerjaan_file" name="bpjs_ketenagakerjaan_file">
                        </div>
                    </div>

                    <!-- Family Card Number -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="family_card_number" class="form-label">Family Card Number</label>
                            <input type="text" class="form-control" placeholder="Ex:32xxxxxxx" id="family_card_number" name="family_card_number" value="{{ old('family_card_number') }}">
                        </div>
                    </div>

                    <!-- Family Card File -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="family_card_file" class="form-label">Family Card File</label>
                            <input type="file" class="form-control" id="family_card_file" name="family_card_file">
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
            const password_confirmation = document.querySelector('input[name="password_confirmation"]').value.trim();
            const password = document.querySelector('input[name="password"]').value.trim();
            const last_name = document.querySelector('input[name="last_name"]').value.trim();
            const employee_code = document.querySelector('input[name="employee_code"]').value.trim();
            const first_name = document.querySelector('input[name="first_name"]').value.trim();
            const email = document.querySelector('input[name="email"]').value.trim();
            const hire_date = document.querySelector('input[name="hire_date"]').value.trim();
            const status_employe = document.querySelector('select[name="status_employe"]').value.trim();
            const status_attendance = document.querySelector('select[name="status_attendance"]').value.trim();

            let isValid = true;
            if (!password_confirmation) {
                showError('Confirm Password cannot be null', 'input[name="password_confirmation"]');
                isValid = false;
            }
            if (!password) {
                showError('Password cannot be null', 'input[name="password"]');
                isValid = false;
            }
            if (!employee_code) {
                showError('Employee Code cannot be null', 'input[name="employee_code"]');
                isValid = false;
            }
            if (!last_name) {
                showError('Username cannot be null', 'input[name="last_name"]');
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
            if (!status_attendance) {
                showError('Status Attendance cannot be null', 'select[name="status_attendance"]');
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
