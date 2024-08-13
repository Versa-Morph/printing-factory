@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add Customer</h4>

            <form class="form-data">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ old('company_name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_code" class="form-label">Company Code</label>
                            <input type="text" class="form-control" id="company_code" name="company_code"
                                value="{{ old('company_code') }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_phone_number" class="form-label">Company Phone Number</label>
                            <input type="text" class="form-control" id="company_phone_number" name="company_phone_number"
                                value="{{ old('company_phone_number') }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_address" class="form-label">Company Address</label>
                            <textarea class="form-control" id="company_address" name="company_address" rows="3">{{ old('company_address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="company_email" class="form-label">Company Email</label>
                            <input type="email" class="form-control" id="company_email" name="company_email"
                                value="{{ old('company_email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pic_name" class="form-label">PIC Name</label>
                            <input type="text" class="form-control" id="pic_name" name="pic_name"
                                value="{{ old('pic_name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="company_status" class="form-label">Company Status</label>
                            <select class="form-select" id="company_status" name="company_status">
                                <option value="">Choose Status</option>
                                <option value="potensial" {{ old('company_status') == 'potensial' ? 'selected' : '' }}>
                                    Potensial</option>
                                <option value="customer" {{ old('company_status') == 'customer' ? 'selected' : '' }}>
                                    Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="pic_phone_number" class="form-label">PIC Phone Number</label>
                            <input type="text" class="form-control" id="pic_phone_number" name="pic_phone_number"
                                value="{{ old('pic_phone_number') }}">
                        </div>

                        <div class="mb-3">
                            <label for="pic_email" class="form-label">PIC Email</label>
                            <input type="email" class="form-control" id="pic_email" name="pic_email"
                                value="{{ old('pic_email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="referral_code" class="form-label">Referral Code</label>
                            <input type="text" class="form-control" id="referral_code" name="referral_code"
                                value="{{ old('referral_code') }}">
                        </div>

                        <div class="mb-3">
                            <label for="company_npwp" class="form-label">Company NPWP</label>
                            <input type="text" class="form-control" id="company_npwp" name="company_npwp"
                                value="{{ old('company_npwp') }}">
                        </div>

                        <div class="mb-3">
                            <label for="billing_address" class="form-label">Billing Address</label>
                            <textarea class="form-control" id="billing_address" name="billing_address" rows="3">{{ old('billing_address') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3">{{ old('shipping_address') }}</textarea>
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
            const referralCode = document.querySelector('input[name="referral_code"]').value.trim();
            const companyNpwp = document.querySelector('input[name="company_npwp"]').value.trim();
            const billingAddress = document.querySelector('textarea[name="billing_address"]').value.trim();
            const shippingAddress = document.querySelector('textarea[name="shipping_address"]').value.trim();
            const companyStatus = document.querySelector('select[name="company_status"]').value.trim(); // Fixed name here

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
            if (!referralCode) {
                showError('Referral Code cannot be null', 'input[name="referral_code"]');
                isValid = false;
            }
            if (!companyNpwp) {
                showError('Company NPWP cannot be null', 'input[name="company_npwp"]');
                isValid = false;
            }
            if (!companyStatus) {
                showError('Company Status cannot be null', 'select[name="company_status"]');
                isValid = false;
            }
            if (!billingAddress) {
                showError('Billing Address cannot be null', 'textarea[name="billing_address"]');
                isValid = false;
            }
            if (!shippingAddress) {
                showError('Shipping Address cannot be null', 'textarea[name="shipping_address"]');
                isValid = false;
            }

            // Submit form if valid
            if (isValid) {
                const formData = new FormData(form);

                $.ajax({
                    url: '{{ route('customer-store') }}',
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
                            window.location.href = '{{ route('customer-list') }}';
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

