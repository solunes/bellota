{{ header('X-UA-Compatible: IE=edge,chrome=1') }}
<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $site->name }} | @yield('title', $site->title)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="@yield('description', $site->description)" />
  <meta name="keywords" content="{{ $site->keywords }}" />
  <meta name="google-site-verification" content="{{ $site->google_verification }}" />
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon/favicon-57.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon/favicon-72.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon/favicon-114.png') }}">
  <link rel="stylesheet" href="{{ url(elixir("assets/css/revolution.css")) }}">
  <link rel="stylesheet" href="{{ url(elixir("assets/css/vendor.css")) }}">
  <link rel="stylesheet" href="{{ url(elixir("assets/css/plugins.css")) }}">
  <link rel="stylesheet" href="{{ url(elixir("assets/css/template.css")) }}">
  <!--<link rel="stylesheet" href="{{ asset('assets/admin/css/master.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">-->
  <link rel="stylesheet" href="{{ url(elixir("assets/css/main.css")) }}">

  @yield('css')
  <!--[if lt IE 9]>
    <script src="{{ url(elixir("assets/js/ie8.js")) }}"></script> 
  <![endif]-->
</head>
<body class="boxed main-site">

  <!-- PRELOADER -->
  <div id="loader">
    <div class="loader-container">
      <img src="{{ asset('assets/images/load.gif') }}" alt="" class="loader-site spinner">
    </div>
  </div>
  <!-- END PRELOADER -->

  <div id="wrapper">
    <header class="header">
      <!-- Header Menu Area -->
      <div class="container-full">
        <nav class="navbar navbar-inverse yamm">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('inicio') }}"><img src="{{ asset('assets/images/logo_bellota.png') }}" alt=""></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                @include('includes.menu', ['items'=> $menu_main->roots()])
              </ul>
              <ul class="nav navbar-nav navbar-right searchandbag">
                @include('includes.cart')
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <!-- Header Menu Area -->
    </header>
    @yield('header')

    @if(Session::has('message_error'))
      <div class="alert alert-danger center">{{ Session::get('message_error') }}</div>
    @elseif (Session::has('message_success'))
      <div class="alert alert-success center">{{ Session::get('message_success') }}</div>
    @endif
    @yield('content')

    <div class="topfooter">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo_bellota_footer.png') }}" alt=""></a>
          </div><!-- end col -->

          <div class="col-md-4 col-sm-4 col-xs-12 text-center payments">
            <a href="#"><i class="fa fa-paypal"></i></a>
            <a href="#"><i class="fa fa-credit-card"></i></a>
          </div><!-- end col -->

          <div class="col-md-4 col-sm-4 col-xs-12 text-right">
            <ul class="list-inline">
              <li><a href="#">Inicio</a></li>
              <li><a href="#">Términos de Uso</a></li>
              <li><a href="#">Contacto</a></li>
              <li><a class="topbutton" href="#">Volver <i class="fa fa-angle-up"></i></a></li>
            </ul>
          </div><!-- end col -->
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end section -->

  </div>

  <!-- Scripts -->
  <script src="{{ url(elixir("assets/js/vendor.js")) }}"></script>
  <script src="{{ url(elixir("assets/js/plugins.js")) }}"></script>
  <script src="{{ url(elixir("assets/js/template.js")) }}"></script>
  <script src="{{ url(elixir("assets/js/revolution.js")) }}"></script>
  @yield('script')

</body>
</html>