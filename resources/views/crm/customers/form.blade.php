<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Satisfaction Survey form Wizard by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>Form Customer</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Caveat|Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('assets/form-customer/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/form-customer/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/form-customer/css/vendors.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/form-customer/css/custom.css') }}" rel="stylesheet">

</head>

<body class="style_2">
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	<header>
	    <div class="container-fluid">
	        <div class="row">
	            <div class="col-5">
	                {{-- <a href="index.html"><img src="img/logo.svg" alt="" width="50" height="55"></a> --}}
	            </div>
	            {{-- <div class="col-7">
	                <div id="social">
	                    <ul>
	                        <li><a href="#0"><i class="social_facebook"></i></a></li>
	                        <li><a href="#0"><i class="social_twitter"></i></a></li>
	                        <li><a href="#0"><i class="social_instagram"></i></a></li>
	                        <li><a href="#0"><i class="social_linkedin"></i></a></li>
	                    </ul>
	                </div>
	            </div> --}}
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	</header>
	<!-- /header -->

	<div class="wrapper_centering">
	    <div class="container_centering">
	        <div class="container">
	            <div class="row justify-content-between">
	                <div class="col-xl-6 col-lg-6 d-flex align-items-center">
	                    <div class="main_title_1">
	                        <h3>
                                {{-- <img src="img/main_icon_1.svg" width="80" height="80" alt="">  --}}
                                Form Customer</h3>
	                        <p>An mei sadipscing dissentiet, eos ea partem viderer facilisi. Brute nostrud democritum in vis, nam ei erat zril mediocrem. No postea diceret vix.</p>
	                        <p><em>- Printing Factory</em></p>
	                    </div>
	                </div>
	                <!-- /col -->
					
					{{-- <form class="form-data"> --}}
						<div class="col-xl-5 col-lg-5">
							<div id="wizard_container">
								<div id="top-wizard">
									<div id="progressbar"></div>
								</div>
								<!-- /top-wizard -->
								<form id="wrapped" class="form-data" autocomplete="off">
									<input id="website" name="website" type="text" value="">
									<!-- Leave for security protection, read docs for details -->
									<div id="middle-wizard">

										<div class="step">
											<h3 class="main_question"><strong>1 of 5</strong>Company Information?</h3>
											<div class="row">
												<div class="col-lg-6 mb-3">
													<label for="company_name" class="form-label">Company Name</label>
													<input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
												</div>
												<div class="col-lg-6 mb-3">
													<label for="company_code" class="form-label">Company Code</label>
													<input type="text" class="form-control" id="company_code" name="company_code" value="{{ old('company_code') }}">
												</div>
												<div class="col-lg-6 mb-3">
													<label for="company_phone_number" class="form-label">Company Phone Number</label>
													<input type="number" class="form-control" id="company_phone_number" name="company_phone_number" value="{{ old('company_phone_number') }}">
												</div>
												<div class="col-lg-6 mb-3">
													<label for="company_email" class="form-label">Company Email</label>
													<input type="email" class="form-control" id="company_email" name="company_email" value="{{ old('company_email') }}">
												</div>
												<div class="col-lg-12 form-group">
													<label for="company_address">Company Address</label>
													<textarea name="company_address" id="company_address" class="form-control" style="height:180px;" onkeyup="getVals(this, 'additional_message');"></textarea>
												</div>
											</div>
										</div>
										<!-- /step 1-->

										<div class="step">
											<h3 class="main_question mb-4"><strong>2 of 5</strong>PIC (Person In Charge) Information</h3>
											<div class="review_block">
												<div class="row">
													<div class="col-lg-6 mb-3">
														<label for="company_name" class="form-label">PIC Name</label>
														<input type="text" class="form-control" id="pic_name" name="pic_name" value="{{ old('pic_name') }}">
													</div>
													<div class="col-lg-6 mb-3">
														<label for="company_name" class="form-label">PIC Phone Number</label>
														<input type="number" class="form-control" id="pic_phone_number" name="pic_phone_number" value="{{ old('pic_phone_number') }}">
													</div>
													<div class="col-lg-12 mb-3">
														<label for="company_name" class="form-label">PIC Email</label>
														<input type="email" class="form-control" id="pic_email" name="pic_email" value="{{ old('pic_email') }}">
													</div>
												</div>
											</div>
										</div>
										<!-- /step 2-->

										<div class="step">
											<h3 class="main_question"><strong>3 of 5</strong>Additional Company Details</h3>
											<div class="review_block">
												<div class="row">
													<div class="col-lg-6 mb-3">
														<label for="referral_code" class="form-label">Referral Code</label>
														<input type="text" class="form-control" id="referral_code" name="referral_code" value="{{ old('company_name') }}">
													</div>
													<div class="col-lg-6 mb-3">
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
											</div>
										</div>
										<!-- /step 3-->

										<div class="submit step">
											<h3 class="main_question"><strong>4 of 4</strong>Addresses</h3>
											<div class="summary">
												<div class="row">
													<div class="col-lg-12 form-group">
														<label for="billing_address">Billing Address</label>
														<textarea name="billing_address" id="billing_address" class="form-control" style="height:180px;" onkeyup="getVals(this, 'billing_address');"></textarea>
													</div>
													<div class="col-lg-12 form-group">
														<label for="shipping_address">Shipping Address</label>
														<textarea name="shipping_address" id="shipping_address" class="form-control" style="height:180px;" onkeyup="getVals(this, 'shipping_address');"></textarea>
													</div>
												</div>
											</div>
										</div>
										<!-- /step 4-->
									</div>
									<!-- /middle-wizard -->

									<div id="bottom-wizard">
										<button type="button" name="backward" class="backward">Prev</button>
										<button type="button" name="forward" class="forward">Next</button>
										<button type="submit" name="process" class="submit">Submit</button>
									</div>
									<!-- /bottom-wizard -->

								</form>
							</div>
							<!-- /Wizard container -->
						</div>
					{{-- </form> --}}
	                <!-- /col -->
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container_centering -->
	    <footer>
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-3">
	                    ©2023 Satisfyc
	                </div>
	            </div>
	            <!-- /row -->
	        </div>
	        <!-- /container-fluid -->
	    </footer>
	    <!-- /footer -->
	</div>
	<!-- /wrapper_centering -->

	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="{{ asset('assets/form-customer/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/form-customer/js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('assets/form-customer/js/functions.js') }}"></script>

	<!-- Wizard script -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('assets/form-customer/js/survey_func.js') }}"></script>
	<script>
		function showLoading(message) {
			Swal.fire({
				title: message,
				allowOutsideClick: false,
				showConfirmButton: false,
				didOpen: () => {
					Swal.showLoading();
				}
			});
		}

		function hideLoading() {
			Swal.close();
		}

		function alertSuccess(msg) {
			Swal.fire({
				position: "center",
				icon: "success",
				title: msg,
				showConfirmButton: false,
				//  timer: 1500
			});
		}

		function alertFailed(msg) {
			Swal.fire({
				icon: "error",
				title: "Oops...",
				text: msg,
				//  timer: 1500
			});
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
				if (!companyStatus) {
					showError('Company Status cannot be null', 'select[name="company_status"]');
					isValid = false;
				}
				
	
				// Submit form if valid
				if (isValid) {
					const formData = new FormData(form);
					console.log(formData);
					
					$.ajax({
						url: '{{ route('customer-form-store') }}',
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
								window.location.href = '{{ route('form-customer') }}';
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
	
			
	
		});
	</script>
</body>
</html>