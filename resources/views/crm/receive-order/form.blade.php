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
	                <div class="col-xl-5 col-lg-5">
	                    <div id="wizard_container">
	                        <div id="top-wizard">
	                            <div id="progressbar"></div>
	                        </div>
	                        <!-- /top-wizard -->
	                        <form id="wrapped" method="POST" autocomplete="off">
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
                                                <label for="company_name" class="form-label">Company Code</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="company_name" class="form-label">Company Phone Number</label>
                                                <input type="number" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="company_name" class="form-label">Company Email</label>
                                                <input type="email" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label for="additional_message_label">Company Address</label>
                                                <textarea name="additional_message" id="additional_message_label" class="form-control" style="height:180px;" onkeyup="getVals(this, 'additional_message');"></textarea>
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
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="company_name" class="form-label">PIC Phone Number</label>
                                                    <input type="number" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label for="company_name" class="form-label">PIC Email</label>
                                                    <input type="email" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
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
                                                    <label for="company_name" class="form-label">Referral Code</label>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
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
                                                    <label for="additional_message_label">Billing Address</label>
                                                    <textarea name="additional_message" id="additional_message_label" class="form-control" style="height:180px;" onkeyup="getVals(this, 'additional_message');"></textarea>
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <label for="additional_message_label">Shipping Address</label>
                                                    <textarea name="additional_message" id="additional_message_label" class="form-control" style="height:180px;" onkeyup="getVals(this, 'additional_message');"></textarea>
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
	                                <button type="button" name="process" class="submit">Submit</button>
	                            </div>
	                            <!-- /bottom-wizard -->

	                        </form>
	                    </div>
	                    <!-- /Wizard container -->
	                </div>
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
	<script src="{{ asset('assets/form-customer/js/survey_func.js') }}"></script>

</body>
</html>