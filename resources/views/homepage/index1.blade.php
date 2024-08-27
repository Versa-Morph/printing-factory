<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8">

    <!-- Page Title -->
    <title>Homepage</title>

    <!-- Meta Tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Viewport Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Template Favicon & Icons Start -->
    <link rel="icon" href="{{ asset('assets/homepage/img/favicon/favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('assets/homepage/img/favicon/icon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('assets/homepage/img/favicon/apple-touch-icon.png') }}">
    <!-- Template Favicon & Icons End -->

    <!-- Facebook Metadata Start -->
    <meta property="og:image:height" content="1200">
    <meta property="og:image:width" content="1200">
    <meta property="og:title" content="Homepage">
    <meta property="og:description" content="Potoplimer">
    <meta property="og:url" content="#!">
    <meta property="og:image" content="#!">

    <!-- Template Styles Start -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/css/plugins-demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/css/main-demo.css') }}">
    <!-- Template Styles End -->

    <!-- Custom Mobile Browser Color Start -->
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#dcdce7">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#111111">
    <meta name="msapplication-navbutton-color" content="#111111">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Custom Mobile Browser Color End -->
  </head>

  <body class="demo">
    <!-- Image Background Layer Start -->
    <div id="imageBackground" class="image-background" data-speed="0.4"></div>
    <!-- Image Background Layer End -->

    <!-- Top Controls (Button and Color Switcher) Start -->
    <div class="demo__controls d-flex">
      <button id="color-switcher" class="color-switcher btn mobile-horizontal btn-square btn-hover btn-hover-transparent" type="button" role="switch" aria-label="light/dark mode" aria-checked="true"></button>
    </div>
    <!-- Top Controls (Button and Color Switcher) End -->

    <!-- Demo Content Start -->
    <main class="demo__content">

      <!-- Intro Start -->
      <section class="demo__intro">

        <div class="intro__header">
          <div class="header__container">
            <div class="container-fluid p-0">
              <div class="row g-0">
                <div class="col-12">
                  <div class="header__logo">
                    <a class="d-flex justify-content-start align-items-center" href="#0" target="_blank"><!-- template link here -->
                      {{-- <div class="logo__image">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                          width="85px" height="85px" viewBox="0 0 85 85"
                          style="enable-background:new 0 0 85 85;" xml:space="preserve" class="gradient-fill">
                          <style type="text/css">
                            .gradient-fill {
                              fill: url(#gradientFill);
                            }
                          </style>
                          <g>
                            <linearGradient id="gradientFill" gradientUnits="userSpaceOnUse" x1="9.9604" y1="75.0338" x2="75.0387" y2="9.9555">
                              <stop  offset="0" style="stop-color:var(--accent)"/>
                              <stop  offset="1" style="stop-color:var(--secondary)"/>
                            </linearGradient>
                            <path class="gradient-fill" d="M51,0H34C15.2,0,0,15.2,0,34v17c0,14.3,8.9,26.6,21.4,31.6c0,0,0,0,0,0l0,0C25.3,84.1,29.5,85,34,85h17
                              c6,0,11.7-1.6,16.6-4.3c0.1-0.1,0.2-0.1,0.3-0.2C78.1,74.6,85,63.6,85,51V34C85,15.2,69.8,0,51,0z M83,51c0,10.7-5.3,20.2-13.4,26
                              v-2.5v-3.9h3.9v-3.9h-3.9v-3.9h3.9v-3.9h-3.9H67v-3.9V51h-3.9v3.9v3.9h2.6v3.9v3.9v3.9h-3.9h-3.9v3.9h3.9h3.9v3.9v1
                              C61.3,81.7,56.3,83,51,83H34c-4.5,0-8.7-0.9-12.6-2.6v-2v-3.9h3.9h3.9v-3.9h-3.9h-3.9v-3.9v-3.9v-3.9H24v-3.9V51h-3.9v3.9v3.9h-2.6
                              h-3.9v3.9h3.9v3.9h-3.9v3.9h3.9v3.9v3.9C8.2,72.8,2,62.6,2,51V34C2,16.4,16.4,2,34,2h17c17.6,0,32,14.4,32,32V51z M50.1,54.9H54
                              v3.9v3.9h-3.9v-3.9V54.9z M33.1,54.9H37v3.9v3.9h-3.9v-3.9V54.9z M27.9,51H24v-3.9v-3.9v-3.9h3.9v3.9v3.9V51z M31.8,39.3h-3.9v-3.9
                              h3.9V39.3z M31.8,43.2v-3.9h3.9v3.9H31.8z M63.1,47.1V51h-3.9v-3.9v-3.9v-3.9h3.9v3.9V47.1z M35.7,47.1v-3.9h3.9h3.9h3.9h3.9v3.9
                              h-3.9h-3.9h-3.9H35.7z M59.2,39.3h-3.9v-3.9h3.9V39.3z M55.3,43.2h-3.9v-3.9h3.9V43.2z"/>
                          </g>
                        </svg>
                      </div> --}}
                      <div class="logo__caption">
                        <p>PLATE MAKING<br> POLIMER</p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="intro__content">
          <div class="headline">
            <p class="headline__subtitle animate-headline">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 13 13" fill="currentColor">
                <path fill="currentColor" d="M5.6,12.6c-0.5-0.8-0.7-2.4-1.7-3.5c-1-1-2.7-1.2-3.5-1.7C-0.1,7-0.1,6,0.4,5.6c0.8-0.5,2.3-0.6,3.5-1.8
                  C5,2.8,5.1,1.2,5.6,0.4C6-0.1,7-0.1,7.4,0.4c0.5,0.8,0.7,2.4,1.8,3.5c1.2,1.2,2.6,1.2,3.5,1.7c0.6,0.4,0.6,1.4,0,1.7
                  C11.8,7.9,10.2,8,9.1,9.1c-1,1-1.2,2.7-1.7,3.5C7,13.1,6,13.1,5.6,12.6z"/>
              </svg>
              <span>ERP SYSTEM</span>
            </p>
            <h1 class="headline__title animate-headline">Empowering plates polimer with seamless ERP solutions</h1>
            <div class="headline__btnholder d-flex flex-column flex-sm-row">
              <a class="btn mobile-vertical btn-default btn-hover btn-hover-accent animate-headline" href="{{ route('form-customer') }}">
                <span class="btn-caption">Website</span>
                <i class="ph-bold ph-globe"></i>
              </a>
              <a class="btn mobile-vertical btn-default btn-hover btn-hover-outline animate-headline" href="{{ route('login') }}">
                <span class="btn-caption">Login</span>
                <i class="ph-bold ph-sign-in"></i>
              </a>
            </div>
          </div>
          <div class="promo-image">
            <img src="{{ asset('assets/image-homepage.png') }}" style="height: 100% !important; margin-right:100px;" alt="test">
          </div>
        </div>

        <div class="marquee">
          <div class="marquee__inner">
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
            <div class="marquee__part">
              ERP Printing Factory
              <div class="star">
                <i class="ph-bold ph-star-four"></i>
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- Intro End -->

    </main>
    <!-- Demo Content End -->

    <!-- Load Scripts Start -->
    <script src="{{ asset('assets/homepage/js/demo/libsdemo.min.js')}}"></script>
    <script src="{{ asset('assets/homepage/js/demo/demo.js')}}"></script>
    <!-- Load Scripts End -->

  </body>

</html>
