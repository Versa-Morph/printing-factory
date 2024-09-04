@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Customer</h4>

            <form class="form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ $customer->company_name }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_code" class="form-label">Company Code</label>
                            <input type="text" class="form-control" id="company_code" name="company_code"
                                value="{{ $customer->company_code }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_phone_number" class="form-label">Company Phone Number</label>
                            <input type="text" class="form-control" id="company_phone_number" name="company_phone_number"
                                value="{{ $customer->company_phone_number }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_address" class="form-label">Company Address</label>
                            <textarea class="form-control" id="company_address" name="company_address" rows="3">{{ $customer->company_address }}</textarea>
                        </div>

                      
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="email" class="form-control" id="company_email" name="company_email"
                                value="{{ $customer->company_email }}">
                        </div>

                        <div class="mb-3">
                            <label for="pic_name" class="form-label">PIC Name</label>
                            <input type="text" class="form-control" id="pic_name" name="pic_name"
                                value="{{ $customer->pic_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="pic_phone_number" class="form-label">PIC Phone Number</label>
                            <input type="text" class="form-control" id="pic_phone_number" name="pic_phone_number"
                                value="{{ $customer->pic_phone_number }}">
                        </div>

                        <div class="mb-3">
                            <label for="pic_email" class="form-label">PIC Email</label>
                            <input type="email" class="form-control" id="pic_email" name="pic_email"
                                value="{{ $customer->pic_email }}">
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary">Update</button>
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
            const companyName = document.querySelector('input[name="company_name"]').value.trim();
            const companyCode = document.querySelector('input[name="company_code"]').value.trim();
            const companyPhoneNumber = document.querySelector('input[name="company_phone_number"]').value.trim();
            const companyAddress = document.querySelector('textarea[name="company_address"]').value.trim();
            const companyEmail = document.querySelector('input[name="company_email"]').value.trim();
            const picName = document.querySelector('input[name="pic_name"]').value.trim();
            const picPhoneNumber = document.querySelector('input[name="pic_phone_number"]').value.trim();
            const picEmail = document.querySelector('input[name="pic_email"]').value.trim();

            let isValid = true;

            // Validation
            if (!companyName) {
                showError('Company Name cannot be null', 'input[name="company_name"]');
                isValid = false;
            }
            if (!companyCode) {
                showError('Company Code cannot be null', 'input[name="company_code"]');
                isValid = false;
            }
            if (!companyPhoneNumber) {
                showError('Company Phone Number cannot be null', 'input[name="company_phone_number"]');
                isValid = false;
            }
            if (!companyAddress) {
                showError('Company Address cannot be null', 'textarea[name="company_address"]');
                isValid = false;
            }
            if (!companyEmail) {
                showError('Company Email cannot be null', 'input[name="company_email"]');
                isValid = false;
            }
            if (!picName) {
                showError('PIC Name cannot be null', 'input[name="pic_name"]');
                isValid = false;
            }
            if (!picPhoneNumber) {
                showError('PIC Phone Number cannot be null', 'input[name="pic_phone_number"]');
                isValid = false;
            }
            if (!picEmail) {
                showError('PIC Email cannot be null', 'input[name="pic_email"]');
                isValid = false;
            }

            // Submit form if valid
            if (isValid) {
                const formData = new FormData(form);

                $.ajax({
                    url: '{{ route('leads-customer-update',$customer->id) }}',
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
                            window.location.href = '{{ route('leads-customer-list') }}';
                        } else {
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

