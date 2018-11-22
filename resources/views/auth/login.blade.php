<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Insight Garage 2.0</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/now-ui-dashboard.min.css?v=1.2.0') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>
    <!-- End Google Tag Manager -->
</head>
<body class="login" style="background-image:url(img/login-bg.jpg)">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="wrapper">
        <div class="top-logo text-center">
            <img class="img-fluid" src="{{ asset('img/gp.png') }}" alt="Business Innovation">
        </div>

        <div class="content">
            <div class="container">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="card card-login card-plain">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-header text-center">
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="login-label" for="email">Email Address</label>
                                    <input type="email" class="form-control login-form-ctrl" name="email">
                                </div>
                                <div class="form-group">
                                    <label class="login-label" for="password">Password</label>
                                    <input type="password" class="form-control login-form-ctrl" name="password">
                                </div>
                                <button type="submit" class="btn btn-info btn-login pull-right">Login <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-login">
            <div class="text-center">
                <p class="h6"><a href="#">FAQ</a> | <a href="#">Contact</a></p>
            </div>
    </div>
</body>
</html>
