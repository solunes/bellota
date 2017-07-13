<div class="{{ $col_md }} col-sm-6 col-xs-12">
  <div class="shop-item text-center">
    <div class="shop-thumbnail">
      <img src="{{ Asset::get_image_path('product-image', 'thumb', $item->image) }}" alt="" class="img-responsive">
    </div><!-- end shop-thumbnail -->
    <div class="shop-desc">
      <h3><a href="{{ url('producto/'.$item->slug) }}" title="">{{ $item->name }}</a></h3>
      <small class="regular">{{ $item->name }}</small>
    </div><!-- end shop-desc -->

    <div class="shop-meta clearfix">
      <ul class="">
        <li><a href="{{ url('producto/'.$item->slug) }}"><i class="fa fa-search"></i> Ver más</a></li>
        <li><a href="{{ url('producto/'.$item->slug) }}"><i class="fa fa-money"></i> Comprar</a></li>
        <li><a href="{{ url('producto/'.$item->slug) }}"><i class="fa fa-cart-plus"></i> Agregar</a></li>
      </ul><!-- end list -->
    </div><!-- end shop-meta --> 
  </div><!-- end shop-item -->
</div><!-- end col -->