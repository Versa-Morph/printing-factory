 <!-- JAVASCRIPT -->
 <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
 <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

 <!-- apexcharts -->
 <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- Vector map-->
 <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

 <!-- swiper js -->
 <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

 <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

 <script src="{{ asset('assets/js/app.js') }}"></script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
 </script>
 @yield('script')
