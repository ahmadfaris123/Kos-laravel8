<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <title>Kosanku</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="/assets/libs/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet">

</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../assets/images/background/login-register.jpg) no-repeat top center;">
        <div class="auth-box p-4 bg-white rounded">
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
            </div>
            @endif
            <div id="loginform">
                <div class="logo">
                    <h3 class="box-title mb-3">Sign In</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" id="loginform" action="/postlogin" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" required="" name="name" placeholder="Username" require>
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="password" required="" name="password" placeholder="Password" require>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <!-- Bootstrap tether Core JavaScript -->
    <script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="/js/app.min.js"></script>
    <script src="/js/app.init.js"></script>
    <script src="/js/app-style-switcher.js"></script>
    <!--Custom JavaScript -->
    <script src="/js/feather.min.js"></script>
    <script src="/js/custom.min.js"></script>
    <script src="/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <script src="/assets/libs/fontawesome/js/all.min.js"></script>
</body>

</html>