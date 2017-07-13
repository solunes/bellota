<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <div class="modal-product">
    <div class="product-images">
      <div class="main-image images">
        <img src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" class="simpleLens-big-image">
      </div>
    </div>
    <div class="product-info">
      <h1>{{ $item->name }}</h1>
      <div class="price-box">
        <p class="price"><span class="special-price"><span class="amount">{!! $item->price_label !!}</span></span></p>
      </div>
      <a href="{{ url('product/'.$item->slug) }}" class="see-all"><i class="fa fa-double-angle-right"></i>Ver más información</a>
      <div class="quick-add-to-cart">
        <form method="post" class="cart" action="{{ url('process/add-cart-item') }}">
          <div class="numbers-row">
            <input name="quantity" type="number" id="french-hens" value="1">
          </div>
          <input name="product_id" type="hidden" value="{{ $item->id }}">
          <button class="single_add_to_cart_button" type="submit">Añadir al Carro</button>
        </form>
      </div>
      <div class="quick-desc">
        {!! $item->summary !!}
      </div>
      <div class="social-sharing">
        <div class="widget widget_socialsharing_widget">
          <h3 class="widget-title-modal">Compartir Producto</h3>
          <ul class="social-icons">
            <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
            <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li>
            <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
            <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div><!-- .product-info -->
  </div>
</div>
<div class="modal-footer">
  <a href="{{ url('process/comprar-ahora/'.$item->slug) }}"><button type="button" class="btn btn-site">Comprar Ahora</button></a>
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>