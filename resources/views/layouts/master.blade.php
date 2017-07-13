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
              <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
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

    <footer class="section footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-12">
            <div class="widget clearfix">
              <div class="widget-title">
                <h4>Business Links</h4>
                <hr>
              </div>

              <div class="link-widget">
                <ul class="check">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">About us</a></li>
                  <li><a href="#">Get In Touch</a></li>
                  <li><a href="#">Refund & Exchange</a></li>
                  <li><a href="#">Support</a></li>
                </ul>
              </div><!-- end link -->
            </div><!-- end widget -->

            <div class="widget clearfix">
              <div class="widget-title">
                <h4>Copyrights</h4>
                <hr>
              </div>

              <div class="link-widget">
                <ul class="check">
                  <li><a href="#">Terms of Usage</a></li>
                  <li><a href="#">Trademarks</a></li>
                  <li><a href="#">Make a Deposite</a></li>
                </ul>
              </div><!-- end link -->
            </div><!-- end widget -->
          </div><!-- end col -->

          <div class="col-md-6 col-sm-12">
            <div class="widget clearfix">
              <div class="widget-title">
                <h4>All Categories</h4>
                <hr>
              </div>

              <div class="link-widget">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <ul class="check">
                      <li><a href="#">Hand tools</a></li>
                      <li><a href="#">Construction market</a></li>
                      <li><a href="#">Chandelier</a></li>
                      <li><a href="#">Garden Furniture</a></li>
                      <li><a href="#">Coffee table</a></li>
                      <li><a href="#">TV unit</a></li>
                      <li><a href="#">Cloakroom</a></li>
                      <li><a href="#">Single Seat</a></li>
                      <li><a href="#">Office Chairs</a></li>
                      <li><a href="#">Coffee Table</a></li>
                      <li><a href="#">Bookshelf</a></li>
                    </ul>
                  </div><!-- end col -->

                  <div class="col-md-4 col-sm-12">
                    <ul class="check">
                      <li><a href="#">Drill</a></li>
                      <li><a href="#">Pique Sets</a></li>
                      <li><a href="#">Sleep set</a></li>
                      <li><a href="#">Hardware</a></li>
                      <li><a href="#">Air conditioning</a></li>
                      <li><a href="#">Jalousie</a></li>
                      <li><a href="#">Sled</a></li>
                      <li><a href="#">Anchor Machine</a></li>
                      <li><a href="#">The Lawn Mower</a></li>
                      <li><a href="#">Submersible Pump</a></li>
                      <li><a href="#">Wall paper</a></li>
                    </ul>
                  </div><!-- end col -->

                  <div class="col-md-4 col-sm-12">
                    <ul class="check">
                      <li><a href="#">Coat Stand</a></li>
                      <li><a href="#">Shoe cabinet</a></li>
                      <li><a href="#">Bathroom Cabinet</a></li>
                      <li><a href="#">Study desk</a></li>
                      <li><a href="#">Home textiles</a></li>
                      <li><a href="#">Wardrobe</a></li>
                      <li><a href="#">Young room</a></li>
                      <li><a href="#">Canvas</a></li>
                      <li><a href="#">Bed</a></li>
                    </ul>
                  </div><!-- end col -->
                </div><!-- end row -->
              </div><!-- end link -->
            </div><!-- end widget -->
          </div><!-- end col -->

          <div class="col-md-3 col-sm-12">
            <div class="widget clearfix">
              <div class="widget-title">
                <h4>Email Newsletter</h4>
                <hr>
              </div>

              <div class="newsletter-widget">
                <p>Subscribe our newsletter for discount and coupon codes.</p>
                <form>
                  <input type="text" class="form-control input-lg" placeholder="Your name" />
                  <input type="email" class="form-control input-lg" placeholder="Email" />
                  <button class="button button--aylen btn">Subscribe Now</button>
                </form>
              </div><!-- end newsletter -->

            </div><!-- end widget -->

            <div class="widget clearfix">
              <div class="row stat-wrapper">
                <div class="stats col-md-6">
                  <h5>Products</h5>
                  <p>122.500</p>
                </div><!-- end stats -->
                <div class="stats col-md-6">
                  <h5>Customers</h5>
                  <p>78.200</p>
                </div><!-- end stats -->
              </div><!-- end row -->
            </div><!-- end widget -->
          </div><!-- end col -->

        </div><!-- end row -->
      </div><!-- end container -->
    </footer>

    <div class="topfooter">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
          </div><!-- end col -->

          <div class="col-md-4 col-sm-4 col-xs-12 text-center payments">
            <a href="#"><i class="fa fa-paypal"></i></a>
            <a href="#"><i class="fa fa-credit-card"></i></a>
            <a href="#"><i class="fa fa-cc-amex"></i></a>
            <a href="#"><i class="fa fa-cc-mastercard"></i></a>
            <a href="#"><i class="fa fa-cc-visa"></i></a>
            <a href="#"><i class="fa fa-cc-diners-club"></i></a>
            <a href="#"><i class="fa fa-cc-discover"></i></a>
          </div><!-- end col -->

          <div class="col-md-4 col-sm-4 col-xs-12 text-right">
            <ul class="list-inline">
              <li><a href="#">Home</a></li>
              <li><a href="#">Terms of Usage</a></li>
              <li><a href="#">Contact</a></li>
              <li><a class="topbutton" href="#">Back <i class="fa fa-angle-up"></i></a></li>
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