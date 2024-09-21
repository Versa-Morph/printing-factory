<!DOCTYPE html>
<html lang="en">

<head>
    {{-- HEAD  --}}
    @include('pwa.layouts.partials.head')
</head>

<body>
    <div class="site-content">
        <!-- Preloader start -->
        <div class="loader-mask">
            <div class="loader">
            </div>
        </div>
        <!-- Preloader end -->
        <!-- Header start -->
        @include('pwa.layouts.partials.header')
        <!-- Header end -->
        <!-- Homescreen content start -->
        @yield('content-pwa')
        <!-- Homescreen content end -->
        <!-- Tabbar start -->
        {{-- bottom nav  --}}
        {{-- @include('pwa.layouts.partials.bottom-navigation') --}}

        <!-- Tabbar end -->
        <!--SideBar setting menu start-->
        {{-- SIDEBAR  --}}
        @include('pwa.layouts.partials.sidebar')

        <div class="dark-overlay"></div>
        <!--SideBar setting menu end-->
        <!-- pwa install app popup Start -->
        {{-- <div class="offcanvas offcanvas-bottom addtohome-popup theme-offcanvas" tabindex="-1" id="offcanvas" aria-modal="true" role="dialog">
			<button type="button" class="btn-close text-reset popup-close-home" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			<div class="offcanvas-body small">
    
				<img src="{{ asset('assets/logo-polimer.png') }}" alt="logo" class="logo-popup" style="max-width: 80%!important;">
				<p class="title font-w600">Printing Factory</p>
				<p class="install-txt">Install Printing Factory - Online Learning & Educational Courses PWA to your home screen for easy access, just like any other app</p>
				<a href="javascript:void(0)" class="theme-btn install-app btn-inline addhome-btn" id="installApp">Add to Home Screen</a>
			</div>
		</div> --}}
        <!-- pwa install app popup End -->
    </div>

    {{-- <script>
        let deferredPrompt;

        // Cek jika sudah ada status instalasi di localStorage
        if (!localStorage.getItem('pwaInstalled')) {
            // Jika belum diinstal, tampilkan popup
            document.getElementById('offcanvas').classList.add('show');
        }

        window.addEventListener('beforeinstallprompt', (e) => {
            // Mencegah prompt default
            e.preventDefault();
            deferredPrompt = e;

            // Event listener untuk tombol "Add to Home Screen"
            document.getElementById('installApp').addEventListener('click', () => {
                if (deferredPrompt) {
                    deferredPrompt.prompt(); // Tampilkan prompt instalasi
                    deferredPrompt.userChoice.then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the A2HS prompt');
                            localStorage.setItem('pwaInstalled', true); // Simpan status instalasi
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                    });
                }
            });
        });

        // Cek apakah PWA sudah diinstal
        window.addEventListener('appinstalled', () => {
            console.log('PWA has been installed');
            localStorage.setItem('pwaInstalled', true); // Simpan status di localStorage
            document.getElementById('offcanvas').classList.remove('show'); // Sembunyikan popup
        });
    </script> --}}


    {{-- FOOT  --}}
    @include('pwa.layouts.partials.foot')

</body>

</html>
