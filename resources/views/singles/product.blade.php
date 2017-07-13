<!-- Single Product Start -->
  <div class="col-md-4 col-sm-6 grid-item">
    <div class="single-product style-two mb-50">
      <div class="single-img">
        <a href="{{ url('product/'.$item->slug) }}">
          <img src="{{ Asset::get_image_path('product-image', 'thumb', $item->image) }}" alt="" />
        </a>
        @if($offer = $item->product_offer)
          <div class="pro-level">{!! $offer->summary_label !!}</div>
        @endif
        <a title="Ver más información" href="{{ url('product-summary/'.$item->id) }}" data-toggle="modal" data-target="#productModal">
          <div class="hover-content text-center">
            <ul><li><span class="zmdi zmdi-collection-plus"></span></li></ul>
          </div>
        </a>
      </div>
      <div class="product-details">
        <div class="product-subdetails">
          <h4><a href="{{ url('product/'.$item->slug) }}">{{ $item->name }}</a><span>{{ $item->category->name }}</span></h4>
          @if(count($item->product_benefits)>0)
            <div class="benefits">
              <ul>
                @foreach($item->product_benefits->take(4) as $benefit)
                  <li>{{ $benefit->name }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
        <div class="row">
          <div class="col-sm-7">
            <div class="price-box">
              {!! $item->price_label !!}
            </div>
          </div>
          <div class="col-sm-5">
            <div class="rating-box">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <div class="deal-btn">
              <a href="{{ url('process/comprar-ahora/'.$item->slug) }}">Comprar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Single Product End -->