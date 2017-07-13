@extends('layouts/master')
@include('helpers.meta')

@section('css')
@endsection

@section('header')
<!-- Banner Area Start -->
<div class="banner-area pb-90 pt-160 bg-2">
  <div class="container">
    <div class="row">
      <div class="banner-content text-center text-white">
        @if(isset($category))
          <h1>{{ $category->name }}</h1>
        @else
          <h1>{{ $page->name }}</h1>
        @endif
        <ul>
          <li><a href="{{ url('') }}">inicio</a> <span class="arrow_carrot-right "></span></li>
          <li>{{ $page->name }}</li>
          @if(isset($category))
            @if($category->parent)
              <li><span class="arrow_carrot-right "></span> {{ $category->parent->name }}</li>
            @endif
            <li><span class="arrow_carrot-right "></span> {{ $category->name }}</li>
          @endif
        </ul> 
      </div>
    </div>
  </div>
</div>
<!-- Banner Area End -->
@endsection

@section('content')
<!-- Product Tab Area Start -->
<section class="product-tab-area pt-90 pb-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @if(count($nodes['products'])>0)
          <div class="grid">
            @foreach($nodes['products'] as $item)
              @include('singles.product')
            @endforeach
          </div>
        @else
          <br><br><br>
          <h3>Actualmente no hay productos disponibles para esta categoría.</h3>
          <br><br><br><br><br><br>
        @endif
      </div>
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