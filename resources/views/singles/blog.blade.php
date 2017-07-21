<div class="blog-wrapper col-md-4 col-sm-6">

  <div class="blog-media">
    <img src="{{ Asset::get_image_path('blog-image','thumb',$item->image) }}" alt="" class="img-responsive">
  </div><!-- end media -->

  <div class="blog-desc">
    <span class="post-date">03 de Junio , 2017</span>
    <h3><a href="#" title="">{{ $item->name }}</a></h3>
    <div class="post-meta">
      <ul class="list-inline">
        <li><a href="#"><i class="fa fa-comment"></i> 04 Comentarios</a></li>
        <li><a href="#"><i class="fa fa-tag"></i> {{ $item->tag }}</a></li>
        <li><a href="#"><i class="fa fa-eye"></i>44 Vistas</a></li>
      </ul><!-- end ul -->
    </div><!-- end meta -->

    {!! $item->summary !!}
  </div><!-- end desc -->

  <div class="blog-bottom clearfix">
    <a href="{{ url('articulo/'.$item->slug) }}" class="button button--aylen btn">Lea el artículo</a>
  </div><!-- end blog-bottom -->
</div><!-- end blog-wrapper -->