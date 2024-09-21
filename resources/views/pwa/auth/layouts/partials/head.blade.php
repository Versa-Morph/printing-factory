<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="icon" href="#!" type="image/x-icon" />
<link rel="shortcut icon" href="#!" type="image/x-icon" />
<title>Printing Factory</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<!--Google font-->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">
<!-- Bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/fontawesome.css') }}">
<!-- Theme css -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/login.css') }}">

<!-- PWA  -->
<meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>

@yield('style-auth')
