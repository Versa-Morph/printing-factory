@extends('auth.layouts.app')

@section('content-auth')
    <div class="auth-page d-flex align-items-center min-vh-100">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="d-flex flex-column h-100 py-5 px-4">
                        <div class="text-center text-muted mb-2">
                            <div class="pb-3">
                                <a href="index.html">
                                    <span class="logo-lg">
                                        <img src="assets/images/logo-sm.svg" alt="" height="24"> <span
                                            class="logo-txt">Vuesy</span>
                                    </span>
                                </a>
                                <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">User Experience & Interface Design
                                    Strategy Saas Solution</p>
                            </div>
                        </div>

                        <div class="my-auto">
                            <div class="p-3 text-center">
                                <img src="assets/images/auth-img.png" alt="" class="img-fluid">
                            </div>
                        </div>

                        <div class="mt-4 mt-md-5 text-center">
                            <p class="mb-0">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Vuesy. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                Themesdesign
                            </p>
                        </div>
                    </div>

                    <!-- end auth full page content -->
                </div>
                <!-- end col -->

                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                        <div class="bg-overlay-gradient"></div>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center g-0 align-items-center w-100">
                            <div class="col-xl-4 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="px-3 py-3">
                                            <div class="text-center">
                                                <h5 class="mb-0">Reset Password</h5>
                                                <p class="text-muted mt-2">Reset Password with Vuesy.</p>
                                            </div>
                                            {{-- <div class="alert font-size-14 alert-success text-center mb-3 mt-5"
                                                role="alert">
                                                Enter your Email and instructions will be sent to you!
                                            </div> --}}
                                            <form class="mt-3 form-data">
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <input type="email" name="email" class="form-control" id="input-email"
                                                        placeholder="Enter Email">
                                                    <label for="input-email">Email</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-envelope-alt"></i>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100">Send Request</button>
                                                </div>

                                            </form><!-- end form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>
@endsection

@section('script-auth')
    {{-- UPDATE  --}}
    <script>
        function alertSuccess(msg) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: msg,
                showConfirmButton: false,
                timer: 1500
            });
        }

        function alertFailed(msg) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: msg,
                timer: 1500
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous validation messages
                const errorElements = document.querySelectorAll('.error-msg');
                errorElements.forEach(function(element) {
                    element.remove();
                });

                const email = document.querySelector('input[name="email"]').value.trim();
                let isValid = true;

                if (!email) {
                    showError('Email tidak boleh kosong', 'input[name="email"]');
                    isValid = false;
                }


                if (isValid) {
                    const formData = new FormData(form);

                    $.ajax({
                        url: '{{ route('forgot-password-send-email') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: response.msg,
                                    showConfirmButton: false,
                                    // timer: 1500
                                });
                                // window.location.href = '{{ route('home') }}';
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.msg,
                                    // timer: 1500
                                });
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
