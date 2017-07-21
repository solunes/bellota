<li class="hidden-sm hidden-xs"><a href="#" data-tooltip="tooltip" data-placement="bottom" title="SÍGUENOS"><i class="fa fa-instagram"></i></a></li>
<li class="dropdown hasmenu shopcartmenu">
  <a href="#" class="dropdown-toggle cart" data-toggle="dropdown" role="button" aria-expanded="false"><span class="countbadge hidden-xs">{{ count($cart_items) }}</span> <i class="fa fa-shopping-bag"></i></a>
  <ul class="dropdown-menu start-right" role="menu">
    <li class="shopcart">
      @if(count($cart_items)>0)
        <table class="table">
          <tbody>
            <?php $total = 0; ?>
            @foreach($cart_items as $item)
              <?php $total += $item->total_price; ?>
              <tr class="row">
              <td class="col-md-3"><img src="{{ Asset::get_image_path('product-image', 'cart', $item->product->image) }}" alt=""></td>
                <td class="col-md-7">
                  <h4><a href="{{ url('product/'.$item->product->slug) }}">{{ $item->product->name }}</a></h4>
                  <small> Precio : Bs. {{ $item->total_price }}</small>
                  <small> Cantidad : {{ $item->quantity }}</small>
                </td>
                <td class="col-md-2"><a href="{{ url('process/delete-cart-item/'.$item->id) }}" class="closeme"><i class="fa fa-close"></i></a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="clearfix"></div>
        <div class="text-center">
          <h3>Subtotal: Bs. {{ $total }}</h3>
          <a href="{{ url('process/confirmar-compra') }}" class="btn btn-primary">Finalizar Compra</a>
        </div>
      @else
        <br><p>Su carro de compras está vacío.</p>
      @endif
    </li>
  </ul>
</li>
<li class="dropdown searchdropdown hasmenu hidden-sm">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
  <ul class="dropdown-menu show-right store_white">
    <li>
      <div id="custom-search-input">
        <div class="input-group col-md-12">
          <input type="text" class="form-control input-lg" placeholder="Busque aquí..." />
          <span class="input-group-btn">
            <button class="button button--aylen btn btn-lg" type="button">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </div>
    </li>
  </ul>
</li>