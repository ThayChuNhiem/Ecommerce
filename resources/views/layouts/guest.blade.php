<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/bundles/jquery-selectric/selectric.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/auth/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/auth/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/auth/img/favicon.ico') }}' />
</head>
<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/auth/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/auth/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/auth/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/auth/js/page/auth-register.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/auth/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/auth/js/custom.js') }}"></script>
</body>
</html>