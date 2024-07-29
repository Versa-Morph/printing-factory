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
                                                <h5 class="mb-0">Forgot Password</h5>
                                                <p class="text-muted mt-2">Forgot Password with Vuesy.</p>
                                            </div>
                                            <form class="mt-3 form-data">
                                                <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password-input" placeholder="Enter Password">
                                                    <label for="password-input">Password Baru</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-padlock"></i>
                                                    </div>
                                                </div>
                                                <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        id="password-confirmation-input" placeholder="Confirm Password">
                                                    <label for="password-confirmation-input">Confirm Password Baru</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-padlock"></i>
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-100">Reset
                                                        Password</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.form-data');
            const urlParams = new URLSearchParams(window.location.search);
            const expiresAt = parseInt(urlParams.get('expires_at'), 10);

            function isExpired() {
                return (Date.now() / 1000) > expiresAt; // Bandingkan waktu saat ini dengan waktu kadaluwarsa
            }

            if (isExpired()) {
                alertFailed('Session expired, please request a new password reset.');
                // Disable form elements or redirect as needed
                form.querySelectorAll('input, button').forEach(el => el.disabled = true);
                return;
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const password = document.querySelector('input[name="password"]').value.trim();
                const passwordConfirmation = document.querySelector('input[name="password_confirmation"]')
                    .value.trim();

                if (password !== passwordConfirmation) {
                    alertFailed('Password dan konfirmasi password tidak cocok.');
                    return;
                }

                const formData = new FormData(form);
                formData.append('token', urlParams.get('token'));
                formData.append('email', urlParams.get('email'));

                $.ajax({
                    url: '{{ route('forgot-password-proses-reset-password') }}',
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
                            // Redirect to login or another page
                            window.location.href = '{{ url('login') }}';
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

                function showError(message, selector) {
                    const element = document.querySelector(selector);
                    const error = document.createElement('span');
                    error.className = 'error-msg text-danger';
                    error.textContent = message;
                    element.parentNode.appendChild(error);
                }
            });

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
        });
    </script>
@endsection
