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
        <h1>{{ $page->name }}</h1>
        <ul>
          <li><a href="{{ url('') }}">inicio</a> <span class="arrow_carrot-right "></span></li>
          <li>{{ $page->name }}</li>
        </ul> 
      </div>
    </div>
  </div>
</div>
<!-- Banner Area End -->
@endsection

@section('content')
  <!-- Single Product Top Info Start -->
  <div class="container">
    <div class="row">
      <p><br><br><br></p>
      <div class="col-md-6">
        <div class="singlepro-left">
          <div class="pro-img-tab-content tab-content">
            <div class="tab-pane active" id="image-1">
              <div class="simpleLens-big-image-container">
                <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="{{ Asset::get_image_path('product-image', 'normal', $item->image) }}" href="img/single-product/1.jpg">
                  <img src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" class="simpleLens-big-image">
                </a>
              </div>
            </div>
          </div>
          <div class="pro-img-tab-slider indicator-style2 owl-carousel owl-theme">
            <div class="item">
              <a href="#image-1" data-toggle="tab"><img src="{{ Asset::get_image_path('product-image', 'subdetail', $item->image) }}" alt="" /></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="singlepro-right">
          <div class="snglepro-content">
            <span>{{ $item->tag }}</span>
            <h3><a href="#">{{ $item->name }}</a></h3>
            <div class="rating-box">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <span>3 calificaciones</span>
            </div>
            <div class="prce-stock">
              <h4>{!! $item->price_label !!}</h4>
            </div>
            {!! $item->summary !!}
            <div class="pro-info">
              <ul>
                <li>SKU: JQK123</li>
                <li>Categoría: {{ $item->category->name }}</li>
              </ul>
            </div>
            <form method="post" action="{{ url('process/add-cart-item') }}">
              <div class="input-content mb-50">
                <label>Seleccionar Cantidad</label>
                <div class="row"></div>
                <div class="quick-add-to-cart">
                  <div class="numbers-row">
                    <input name="quantity" type="number" id="french-hens" value="1">
                  </div>
                  <button class="single_add_to_cart_button" type="submit">Añadir al Carro</button>
                </div>
                <div class="row"></div>
                <div class="deal-btn">
                  <br>
                  <input name="product_id" type="hidden" value="{{ $item->id }}">
                  <a href="{{ url('process/comprar-ahora/'.$item->slug) }}">Comprar Ahora</a>
                </div>
              </div>
            </form>
            <div class="sngle-pro-socl">
              <ul>
                <li><a href="#" class="social_facebook"></a></li>
                <li><a href="#" class="social_googleplus"></a></li>
                <li><a href="#" class="social_twitter"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Single Product Top Info Start -->
  <!-- Single Product Discription Start -->
  <section class="pro-disciptin mt-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="p-details-tab">
            <ul role="tablist">
              <li role="presentation" class="active">
                <a href="#content" aria-controls="content" role="tab" data-toggle="tab">Descripción</a>
              </li>
              <li role="presentation">
                <a href="#info" aria-controls="info" role="tab" data-toggle="tab">Beneficios</a>
              </li>
              <li role="presentation">
                <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Comentarios (3)</a>
              </li>
            </ul>
          </div>
          <div class="tab-content review">
            <div role="tabpanel" class="tab-pane active" id="content">
              {!! $item->content !!}
            </div>
            <div role="tabpanel" class="tab-pane benefits" id="info">
              <p>Este producto cuenta con los siguientes beneficios.</p>
              <ul>
                @foreach($item->product_benefits as $benefit)
                  <li>{{ $benefit->name }}</li>
                @endforeach
              </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="reviews">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum d</p>
            </div>
          </div>
        </div>
      </div>
      <p><br><br><br></p>
    </div>
  </section>
  <!-- Single Product Discription End -->
@endsection

@section('script')
@endsection