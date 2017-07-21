<div class="section-title text-center clearfix">
  <h4>Blog</h4>
  <p>No olvides revisar algunos tutoriales y publicaciones para que aprendas<br> como utilizar nuestros productos con nosotros.</p>
  <hr>
</div><!-- end title -->

<div class="blog-list row">
  @foreach($items as $blog)
    @include('singles.blog', ['item'=>$blog])
  @endforeach

</div><!-- end blog-list -->