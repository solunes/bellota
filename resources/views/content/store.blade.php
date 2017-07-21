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
      <h2>{{ $page->name }} <small>Bellota Scrapbooking Store!</small></h2>
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

            <div class="about-desc">
              <h4>Bellota Scrapbooking</h4>
              <small>Tu tienda favorita</small>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultricies sollicitudin lacus, at iaculis ligula convallis ultrices. Donec eget tempor lorem, a porttitor ligula. Vestibulum erat libero, hendrerit eu nibh a, auctor aliquet quam.</p>
            </div>
          </div>
          <!-- end about-widget -->
        </div>
        <!-- end widget -->

        <div class="widget clearfix">
          <div class="widget-title">
            <h4>Nuestras Redes Sociales</h4>
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