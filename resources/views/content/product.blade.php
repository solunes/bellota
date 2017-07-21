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
      <h2>{{ $item->category->name }} <small>{{ $item->name }}</small></h2>
    </div><!-- /.pull-right -->
    <div class="pull-right hidden-xs">
      <div class="bread">
        <ol class="breadcrumb">
          <li><a href="#">{{ $item->category->name }}</a></li>
          <li class="active">{{ $item->name }}</li>
        </ol>
      </div><!-- end bread -->
    </div><!-- /.pull-right -->
  </div>
</div><!-- end page-title -->
<section class="section lb">
  <div class="container">
    <div class="row">
      <div id="content" class="col-md-9 col-sm-12 single-blog">

        <div class="row">
          <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="product-images">
             <a data-rel="prettyPhoto" href="{{ Asset::get_image_path('product-image', 'normal', $item->image) }}" title="">
              <img class="img-responsive" src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" />
            </a>
            <ul class="thumbnail">
              <li> <a data-rel="prettyPhoto[gallery]" href="{{ Asset::get_image_path('product-image', 'normal', $item->image) }}" title=""><img class="img-responsive" src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" /></a></li>
              <li> <a data-rel="prettyPhoto[gallery]" href="{{ Asset::get_image_path('product-image', 'normal', $item->image) }}" title=""><img class="img-responsive"  src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" /></a></li>
              <li> <a data-rel="prettyPhoto[gallery]" href="{{ Asset::get_image_path('product-image', 'normal', $item->image) }}" title=""><img class="img-responsive"  src="{{ Asset::get_image_path('product-image', 'detail', $item->image) }}" alt="" /></a></li>
            </ul>
          </div>
        </div><!-- end col -->
        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="shop-desc bgw">
            <h3>{{ $item->name }} </h3>
            <small>{{ $item->real_price }}</small>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            {!! $item->summary !!}

            <a href="{{ url('process/comprar-ahora/'.$item->slug) }}" class="button button--aylen btn">Comprar ahora</a>

            <div class="addwish">
              <a href="{{ url('process/add-cart-item/'.$item->id) }}"><i class="fa fa-cart-plus"></i> Añadir al Carro</a>
            </div><!-- end addw -->
            <div class="shopmeta">
              <span><strong>Categoría:</strong> <a href="{{ url('categoria/'.$item->category->slug) }}">{{ $item->category->name }}</a></span>
              <span><strong>Etiquetas:</strong> <a href="#">Furniture</a>, <a href="#">Art</a></span>
            </div><!-- end shopmeta -->

          </div><!-- end desc -->
        </div><!-- end col -->
      </div><!-- end row -->

      <hr class="invis">

      <div class="row">
        <div class="col-md-12">
          <div class="tab-style-1">
            <div class="tabbed-widget">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Descripción</a></li>
                <li><a data-toggle="tab" href="#menu1">Comentarios</a></li>
              </ul>

              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  {!! $item->content !!}
                </div>
                <div id="menu1" class="tab-pane fade">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel">
                        <div class="panel-body comments">
                          <ul class="media-list">
                            <li class="media">
                              <div class="comment">
                                <a href="#" class="pull-left">
                                  <img src="{{ asset('assets/upload/avatar_01.jpg') }}" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                  <strong class="text-success">Jane Doe</strong>
                                  <span class="text-muted">
                                    <small class="text-muted">6 días atras</small></span>
                                    <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, <a href="#">#some link </a>.
                                    </p>
                                    <a href="#" class="btn btn-primary btn-sm">Responder</a>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                                <ul class="media-list">
                                  <li class="media">
                                    <div class="comment">
                                      <a href="#" class="pull-left">
                                        <img src="{{ asset('assets/upload/avatar_02.png') }}" alt="" class="img-circle">
                                      </a>
                                      <div class="media-body">
                                        <strong class="text-success">Sergio</strong>
                                        <span class="text-muted">
                                          <small class="text-muted">2 días atras</small></span>
                                          <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                          </p>
                                          <a href="#" class="btn btn-primary btn-sm">Responder</a>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </li>
                                    <li class="media">
                                      <div class="comment">
                                        <a href="#" class="pull-left">
                                          <img src="{{ asset('assets/upload/avatar_03.png') }}" alt="" class="img-circle">
                                        </a>
                                        <div class="media-body">
                                          <strong class="text-success">Lucia</strong>
                                          <span class="text-muted">
                                            <small class="text-muted">15 minutos atras</small></span>
                                            <p>
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                            </p>
                                            <a href="#" class="btn btn-primary btn-sm">Responder</a>
                                          </div>
                                          <div class="clearfix"></div>
                                        </div>
                                      </li>
                                    </ul>
                                  </li>
                                  <li class="media">
                                    <div class="comment">
                                      <a href="#" class="pull-left">
                                        <img src="{{ asset('assets/upload/avatar_04.png') }}" alt="" class="img-circle">
                                      </a>
                                      <div class="media-body">
                                        <strong class="text-success">Jana Cova</strong>
                                        <span class="text-muted">
                                          <small class="text-muted">12 days ago</small></span>
                                          <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                          </p>
                                          <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </li>
                                    <li class="media">
                                      <div class="comment">
                                        <a href="#" class="pull-left">
                                          <img src="{{ asset('assets/upload/avatar_04.png') }}" alt="" class="img-circle">
                                        </a>
                                        <div class="media-body">
                                          <strong class="text-success">Johnatan Smarty</strong>
                                          <span class="text-muted">
                                            <small class="text-muted">1 month ago</small></span>
                                            <p>
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
                                            </p>
                                            <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                          </div>
                                          <div class="clearfix"></div>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>

                              </div><!-- end postpager -->

                              <div class="contact_form blog-desc">
                                <div class="widget-title">
                                  <h4>Deje un comentario</h4>
                                  <hr>
                                </div>

                                <div class="contact_form">
                                  <form class="row">
                                    <div class="col-md-4 col-sm-12">
                                      <label>Nombre <span class="required">*</span></label>
                                      <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                      <label>Email <span class="required">*</span></label>
                                      <input type="email" class="form-control" placeholder="">
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <label>Comentario <span class="required">*</span></label>
                                      <textarea class="form-control" placeholder=""></textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                      <input type="submit" value="Enviar Comentario" class="btn btn-primary" />
                                    </div>
                                  </form>
                                </div><!-- end commentform -->
                              </div><!-- end postpager -->
                            </div><!-- end content -->
                          </div>
                        </div>
                      </div>
                      <!-- end tabbed-widget -->
                    </div>
                    <!-- end service-style-1 -->
                  </div>
                  <!-- end col -->
                </div>
                <!-- end row -->

              </div><!-- end content -->

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
            </div><!-- end row -->
  </div>
</section>
@endsection

@section('script')
@endsection