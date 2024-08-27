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
    <!-- Facebook Metadata End -->

    <!-- Template Styles Start -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/css/loaders/loader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/homepage/css/main.css') }}">
    <!-- Template Styles End -->

    <!-- Custom Browser Color Start -->
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#dcdce7">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#111111">
    <meta name="msapplication-navbutton-color" content="#111111">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Custom Browser Color End -->
  </head>

  <body>

    <!-- Loader Start -->
    {{-- <div id="loader" class="loader">
      <div id="loaderContent" class="loader__content">
        <div class="loader__shadow"></div>
        <div class="loader__box"></div>
      </div>
    </div> --}}
    <!-- Loader End -->

    <!-- Header Start -->
    <header id="header" class="header d-flex justify-content-between">

      <!-- Navigation Menu Start -->
      <div class="header__navigation">
        <nav id="menu" class="menu">
          <ul class="menu__list d-flex justify-content-start">
            {{-- <li class="menu__item">
              <a class="menu__link btn" href="#home">
                <span class="menu__caption">Home</span>
                <i class="ph-bold ph-house-simple"></i>
              </a>
            </li>
            <li class="menu__item">
              <a class="menu__link btn" href="#portfolio">
                <span class="menu__caption">Portfolio</span>
                <i class="ph-bold ph-squares-four"></i>
              </a>
            </li>
            <li class="menu__item">
              <a class="menu__link btn" href="#about">
                <span class="menu__caption">About Me</span>
                <i class="ph-bold ph-user"></i>
              </a>
            </li>
            <li class="menu__item">
              <a class="menu__link btn" href="#resume">
                <span class="menu__caption">Resume</span>
                <i class="ph-bold ph-article"></i>
              </a>
            </li>
            <li class="menu__item">
              <a class="menu__link btn" href="#contact">
                <span class="menu__caption">Contact</span>
                <i class="ph-bold ph-envelope"></i>
              </a>
            </li> --}}
          </ul>
        </nav>
      </div>
      <!-- Navigation Menu End -->

      <!-- Header Controls Start -->
      <div class="header__controls d-flex justify-content-end">
        <button id="color-switcher" class="color-switcher header__switcher btn" type="button" role="switch" aria-label="light/dark mode" aria-checked="true"></button>
        {{-- <a id="notify-trigger" class="header__trigger btn" href="mailto:example@example.com?subject=Message%20from%20your%20site">
          <span class="trigger__caption">Let's Talk</span>
          <i class="ph-bold ph-chat-dots"></i>
        </a> --}}
      </div>
      <!-- Header Controls End -->

    </header>
    <!-- Header End -->

    <!-- Avatar Side Block Start -->
    <div id="avatar" class="avatar">
      <div class="avatar__container d-flex flex-column justify-content-lg-start gap-4">
        <!-- image and logo -->
        <div class="avatar__block">
          <div class="avatar__image">
            <img src="{{ asset('assets/logo-polimer.png') }}" alt="">
          </div>
        </div>
        <!-- data caption #1 -->
        {{-- <div class="avatar__block mt-auto">
            <h6>
              <small class="top">Name:</small>
              {{ Auth::user()->name }}
            </h6>
        </div>
          <!-- data caption #2 -->
        <div class="avatar__block">
            <h6>
              <small class="top">Role:</small>
              {{ Auth::user()->getRoleNames()[0] }}
            </h6>
        </div>
          <!-- data caption #2 -->
        <div class="avatar__block mb-3">
            <h6>
              <small class="top">Office:</small>
              Tangerang, Banten
            </h6>
        </div> --}}
        <!-- socials and CTA button -->
        <div class="avatar__block">
          {{-- <div class="avatar__socials">
            <ul class="socials-square d-flex justify-content-between">
              <li class="socials-square__item">
                <a class="socials-square__link btn" href="https://dribbble.com/" target="_blank"><i class="ph-bold ph-dribbble-logo"></i></a>
              </li>
              <li class="socials-square__item">
                <a class="socials-square__link btn" href="https://www.behance.net/" target="_blank"><i class="ph-bold ph-behance-logo"></i></a>
              </li>
              <li class="socials-square__item">
                <a class="socials-square__link btn" href="https://www.instagram.com/" target="_blank"><i class="ph-bold ph-instagram-logo"></i></a>
              </li>
              <li class="socials-square__item">
                <a class="socials-square__link btn" href="https://www.twitch.tv/" target="_blank"><i class="ph-bold ph-twitch-logo"></i></a>
              </li>
              <li class="socials-square__item">
                <a class="socials-square__link btn" href="https://www.pinterest.com/" target="_blank"><i class="ph-bold ph-pinterest-logo"></i></a>
              </li>
            </ul>
          </div> --}}
          <div class="avatar__btnholder">
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Dashboard</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Absent</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Client Visit</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Time Sheet / To do List</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Reimbursment</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Lend App</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Shifting</span>
            </a>
            <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent mb-3" href="{{ route('homepage-role') }}">
              <span class="btn-caption">Overtime</span>
            </a>
            {{-- <a class="btn btn-default btn-fullwidth btn-hover btn-hover-accent" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span class="btn-caption">Logout</span>
            </a> --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Avatar Side Block End -->

    <!-- Page Content Start -->
    <div id="content" class="content">
      <div class="content__wrapper">
            <!-- About Section Start -->
        <section id="about" class="inner about">
            <!-- Content Block - Achievements Start -->
            <div class="content__block grid-block">
              <div class="achievements d-flex flex-column flex-md-row align-items-md-stretch">
                <!-- achievements single item -->
                <!-- achievements single item -->
                <div class="achievements__item d-flex flex-column grid-item animate-card-3">
                    <div class="achievements__card">
                      <p class="achievements__number">22</p>
                      <p class="achievements__descr">Attendance</p>
                    </div>
                  </div>
                  <!-- achievements single item -->
                  <div class="achievements__item d-flex flex-column grid-item animate-card-3">
                    <div class="achievements__card">
                      <p class="achievements__number">3</p>
                      <p class="achievements__descr">Late</p>
                    </div>
                  </div>
                <div class="achievements__item d-flex flex-column grid-item animate-card-3">
                  <div class="achievements__card">
                    <p class="achievements__number">3</p>
                    <p class="achievements__descr">Absent</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Content Block - Achievements End -->

            <!-- Content Block - About Me Data Start -->
            <div class="content__block grid-block block-large">
              <div class="container-fluid p-0">
                <div class="row g-0 justify-content-between">

                  <!-- About Me Description Start -->
                  {{-- <div class="col-12 col-xl-8 grid-item about-descr">
                    <p class="about-descr__text animate-in-up">
                      I wonder if I've been changed in the night? Let me think. Was I the same when I got up this morning?
                      I almost think I can remember feeling a little different.
                      But if I'm not the same, the
                      <a href="#0" class="text-link">next question</a>
                      is 'Who in the world am I?' Ah, that's the great puzzle!
                    </p>
                    <p class="about-descr__text animate-in-up">
                      Be what you would seem to be - or, if you'd like it put more simply - never imagine yourself not to be otherwise
                      than what it might appear to others that what you were or
                      <a href="#0" class="text-link">might have been</a>
                      was not otherwise than what you had been
                      would have appeared to them to be otherwise.
                    </p>
                    <div class="btn-group about-descr__btnholder animate-in-up">
                      <a class="btn mobile-vertical btn-default btn-hover btn-hover-accent" href="#0">
                        <span class="btn-caption">Absensi</span>
                      </a>
                    </div>
                  </div> --}}
                  {{-- <table class="table align-middle table-nowrap table-check" id="gaji-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Check in</th>
                            <th>Check out</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table> --}}
                  <!-- About Me Description End -->

                  <!-- About Me Information Start -->
                  <div class="col-12 col-xl-4 grid-item about-info">
                    <div class="about-info__item animate-in-up">
                      <h6>
                        <small class="top">Name</small>
                        Alex Walker
                      </h6>
                    </div>
                    <div class="about-info__item animate-in-up">
                      <h6>
                        <small class="top">Phone</small>
                        <a class="text-link-bold" href="tel:+12127089400">+1 212-708-9400</a>
                      </h6>
                    </div>
                    <div class="about-info__item animate-in-up">
                      <h6>
                        <small class="top">Email</small>
                        <a class="text-link-bold" href="mailto:example@example.com?subject=Message%20from%20your%20site">hello@yourdomain.com</a>
                      </h6>
                    </div>
                    <div class="about-info__item animate-in-up">
                      <h6>
                        <small class="top">Location</small>
                        <a class="text-link-bold" href="https://maps.app.goo.gl/xMJXTEUeHkv6kYRQ6" target="_blank">Odesa, Ukraine</a>
                      </h6>
                    </div>
                  </div>
                  <!-- About Me Information End -->

                </div>
              </div>
            </div>
            <!-- Content Block - About Me Data End -->
        </section>
          <!-- About Section End -->
      </div>
    </div>
    <!-- Page Content End -->

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

      <!-- Background of PhotoSwipe.
      It's a separate element, as animating opacity is faster than rgba(). -->
      <div class="pswp__bg"></div>

      <!-- Slides wrapper with overflow:hidden. -->
      <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

          <div class="pswp__top-bar">

            <!--  Controls are self-explanatory. Order can be changed. -->

            <div class="pswp__counter"></div>

            <button class="pswp__button pswp__button--close link-s" title="Close (Esc)"></button>

            <button class="pswp__button pswp__button--fs link-s" title="Toggle fullscreen"></button>

            <button class="pswp__button pswp__button--zoom link-s" title="Zoom in/out"></button>

            <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
            <!-- element will get class pswp__preloader-active when preloader is running -->
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
              <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left link-s" title="Previous (arrow left)"></button>

            <button class="pswp__button pswp__button--arrow--right link-s" title="Next (arrow right)"></button>

            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>

        </div>

      </div>

    </div>

    <!-- Load Scripts Start -->
    <script src="{{ asset('assets/homepage/js/libs.min.js') }}"></script>
    <script>
      gsap.registerPlugin(ScrollTrigger);

      const content = document.querySelector('body');
      const imgLoad = imagesLoaded(content);
      const svgBackground = document.querySelector("svg-background");

      imgLoad.on('done', instance => {

        document.getElementById("loaderContent").classList.add("fade-out");
        setTimeout(() => {
          document.getElementById("loader").classList.add("loaded");
        }, 300);

        gsap.set(".animate-headline", {y: 50, opacity: 0});
        ScrollTrigger.batch(".animate-headline", {
          interval: 0.1,
          batchMax: 4,
          duration: 6,
          onEnter: batch => gsap.to(batch, {
            opacity: 1,
            y: 0,
            ease: 'sine',
            stagger: {each: 0.15, grid: [1, 4]},
            overwrite: true
          }),
          onLeave: batch => gsap.set(batch, {opacity: 1, y: 0, overwrite: true}),
          onEnterBack: batch => gsap.to(batch, {opacity: 1, y: 0, stagger: 0.15, overwrite: true}),
          onLeaveBack: batch => gsap.set(batch, {opacity: 0, y: 50, overwrite: true})
        });

      });
    </script>
    <script src="{{ asset('assets/homepage/js/app.js') }}"></script>
    <script src="{{ asset('assets/homepage/js/gallery-init.js') }}"></script>
    <!-- Load Scripts End -->

  </body>

</html>
