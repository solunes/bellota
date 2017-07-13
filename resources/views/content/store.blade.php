@extends('layouts/master')
@include('helpers.meta')

@section('css')
@endsection

@section('header')
<section class="section paralbackground page-banner hidden-xs" style="background-image:url('{{ asset('assets/upload/page_banner_about.jpg') }}');" data-img-width="2000" data-img-height="400" data-diff="100">
</section>
@endsection

@section('content')
<div class="page-title">
  <div class="container clearfix">
    <div class="title-area pull-left">
      <h2>{{ $page->name }} <small>Beautiful Home Decoration Materials!</small></h2>
    </div><!-- /.pull-right -->
    <div class="pull-right hidden-xs">
      <div class="bread">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">{{ $page->name }}</li>
        </ol>
      </div><!-- end bread -->
    </div><!-- /.pull-right -->
  </div>
</div><!-- end page-title -->
<section class="section lb">
  <div class="container">
    <div class="row">
      <div id="content" class="col-md-9 col-sm-12 single-blog">
        @if(count($nodes['products'])>0)
          <div class="row shop-list">
            @foreach($nodes['products'] as $item)
              @include('singles.product', ['col_md'=>'col-md-4'])
            @endforeach
          </div>
        @else
          <br><br><br>
          <h3>Actualmente no hay productos disponibles para esta categoría.</h3>
          <br><br><br><br><br><br>
        @endif
      </div>
      <div id="sidebar" class="col-md-3 col-sm-12">
        <div class="widget clearfix">
          <div class="about-widget">
            <div class="post-media">
            <img src="{{ asset('assets/upload/me.jpg') }}" alt="" class="img-responsive">
            </div>

            <div class="social-icons">
              <ul class="list-inline">
                <li class="facebook"><a data-tooltip="tooltip" data-placement="top" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="google"><a data-tooltip="tooltip" data-placement="top" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                <li class="twitter"><a data-tooltip="tooltip" data-placement="top" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="linkedin"><a data-tooltip="tooltip" data-placement="top" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                <li class="pinterest"><a data-tooltip="tooltip" data-placement="top" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                <li class="skype"><a data-tooltip="tooltip" data-placement="top" title="Skype" href="#"><i class="fa fa-skype"></i></a></li>
              </ul>
            </div><!-- end social icons -->

            <div class="about-desc">
              <h4>John BRITTO</h4>
              <small>Junior Web Designer</small>
              <p>Welcome to my portfolio, my name is John. I create handcraft web design and graphic sources for beginners like me.</p>
              <img src="{{ asset('assets/upload/signature.png') }}" alt="">
            </div>
          </div>
          <!-- end about-widget -->
        </div>
        <!-- end widget -->

        <div class="widget clearfix">
          <div class="widget-title">
            <h4>Be Social</h4>
            <hr>
          </div>
          <div class="menu-widget">
            <ul class="check">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Google Plus</a></li>
              <li><a href="#">Pinterest</a></li>
              <li><a href="#">Dribbble</a></li>
            </ul>
          </div>
          <!-- end menu-widget -->
        </div>
        <!-- end widget -->

        <div class="widget clearfix">
          <div class="widget-title">
            <h4>Tags</h4>
            <hr>
          </div>
          <div class="tags">
            <a href="#">design</a>
            <a href="#">art</a>
            <a href="#">photo</a>
            <a href="#">student</a>
            <a href="#">material</a>
            <a href="#">app</a>
            <a href="#">yellow</a>
            <a href="#">light</a>
          </div>
          <!-- end tags-widget -->
        </div>
        <!-- end widget -->
      </div><!-- end sidebar -->
    </div>
  </div>
</section>
<!-- Product Tab Area End -->
@endsection

@section('script')
  <script type="text/javascript">
    $(function(){
      var $container = $('.grid');
      $container.imagesLoaded( function(){
        $container.isotope({
          itemSelector: '.grid-item',
          percentPosition: true,
          masonry: {
            columnWidth: '.grid-item'
          }
        });
      });
    });
  </script>
@endsection