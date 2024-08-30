 <!-- JAVASCRIPT -->
 <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
 <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
 <script src="{{ asset('assets/role/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

 <!-- Vector map-->
 <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
 <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

 <!-- swiper js -->
 <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>


 <script src="{{ asset('assets/js/app.js') }}"></script>
 <!-- apexcharts -->
 <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 @stack('scripts')
 <script>
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

     function formatRupiah(value) {
        if (!value) return 'Rp 0';

        // Remove any non-numeric characters (except for dots) and ensure it's a float
        value = parseFloat(value.toString().replace(/[^0-9.]/g, ''));

        // Convert to string and split into integer and decimal parts
        let parts = value.toFixed(2).split('.');
        let integerPart = parts[0];
        let decimalPart = parts[1];

        // Add Rupiah separator to the integer part
        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Combine integer part with decimal part only if it's non-zero
        return `Rp ${integerPart}${decimalPart === '00' ? '' : `,${decimalPart}`}`;
    }

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

    $(document).ajaxStart(function() {
        showLoading('Processing Request.....');
    }).ajaxStop(function() {
        hideLoading();
    });

 </script>
 @yield('script')
