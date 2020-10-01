<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Patient Tracking System</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('medicio assets/vendor/bootstrap/css/bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('medicio assets/vendor/icofont/icofont.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('medicio assets/vendor/boxicons/css/boxicons.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('medicio assets/vendor/animate.css/animate.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('medicio assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('medicio assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('medicio assets/vendor/aos/aos.css') }}" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="{{ asset('medicio assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo mr-auto"><a href="/">PTS</a></h1>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="/#about">About</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/#roles">Roles</a></li>
                    <li><a href="/#request">Request</a></li>
                    <li><a href="/#supplier">Supplier</a></li>
                    <li><a href="/#contact">Contact</a></li>
                </ul>
            </nav><!-- .nav-menu -->

            <a href="{{ route('login') }}" class="appointment-btn scrollto">Login</a>

        </div>
    </header><!-- End Header -->






    <main id="main">

        @yield('content')

    </main>



    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


    <!-- Vendor JS Files -->

    <script src="{{ asset('medicio assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('medicio assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('medicio assets/vendor/jquery.easing/jquery.easing.min.js') }}">
    </script>
    <script src="{{ asset('medicio assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('medicio assets/vendor/waypoints/jquery.waypoints.min.js') }}">
    </script>
    <script src="{{ asset('medicio assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('medicio assets/vendor/owl.carousel/owl.carousel.min.js') }}">
    </script>
    <script src="{{ asset('medicio assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('medicio assets/vendor/aos/aos.js') }}"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('medicio assets/js/main.js') }}"></script>

</body>

</html>
