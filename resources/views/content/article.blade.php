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
      <h2>{{ $page->name }} <small>{{ $item->name }}</small></h2>
    </div><!-- /.pull-right -->
    <div class="pull-right hidden-xs">
      <div class="bread">
        <ol class="breadcrumb">
          <li><a href="#">{{ $page->name }}</a></li>
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
          <div class="blog-wrapper col-md-12">
            <div class="blog-media">
              <img src="../assets/upload/blog_02.jpg" alt="" class="img-responsive">
            </div><!-- end media -->

            <div class="blog-desc">
              <span class="post-date">May 13, 2016</span>
              <h3><a href="single.html" title="">Green Corner</a></h3>
              <div class="post-meta">
                <ul class="list-inline">
                  <li><a href="#"><i class="fa fa-comment"></i> 04 Comments</a></li>
                  <li><a href="#"><i class="fa fa-tag"></i> Furniture</a></li>
                  <li><a href="#"><i class="fa fa-eye"></i>44 Views</a></li>
                </ul><!-- end ul -->
              </div><!-- end meta -->

              <p>Morbi congue leo et est sodales consequat a quis est. Nunc aliquam ut massa et accumsan. Donec cursus pretium porta. Maecenas vehicula pellentesque eros, non consectetur massa finibus quis. Ut ut rpat. Praesent lorem nisi vehicula fringilla rutrum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilisut magna fringilla vulputate quis non ante. Integer bibendum velit dui. Sed consequat nisi id convallis eleifend. Proin rhoncus dapibus vulputate. Phasellus eget fringilla justo. Aliquam erat volutpat. Praesent lorem nisi vehicula fringilla ruhoncus purus. Donec varius ultricies dapibus. Aliquam facilisis lacus purus, sit amet maximus lectus auctor et. Nam vehicula eget leo sed gravida.</p>

              <p><img src="../assets/upload/alignleft.png" alt="" class="alignleft">Phasellus eget fringilla justo. Aliquam erat volutpat. <a href="#">Praesent lorem nisi</a> vehicula fringilla rutrum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilisi. Phasellus aliquet est ac faucibus iaculis. <strong>Sed non lorem in quam placerat</strong> facilisis necut magna fringilla vulputate quis non ante. Integer bibendum velit dui. Sed consequat nisi id convallis eleifend. Proin rhoncus dapibus vulputate. Phasellus eget fringilla justo. Aliquam erat volutt ante. Integer bibendum velit dui. Sed consequat nisi id convallis eleifend. Proin rhoncus dapibus vulputate. Phasellus eget fringilla justo. Aliquam erat volutpat. Praesent lorem nisi vehicula fringilla rutrum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilisut magna fringilla vulputate quis non ante. Integer bibendum velit dui. Sed consequat nisi id convallis eleifend. Proin rhoncus dapibus vulputate. Phasellus eget fringilla justo. Aliquam erat volutpat. Praesent lorem nisi vehicula fringilla rutrum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilis eu quam. Etirum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilis eu quam. Etiam at tincidunt felis, et posuere eros. Nulla dictum id enim vitae fermentum. </p>

              <blockquote>
                <p>Love can travel a thousand miles. Life has no limit. Go where you want to go. Reach the height you want to reach. It is all in your heart and in your hands.</p>
                <footer><cite title="Source Title">Steave Jobs</cite></footer>
              </blockquote>

              <p><img src="../assets/upload/alignright.png" alt="" class="alignright">Suspendisse quis dignissim diam, id faucibus sapien. Integer et egestas elit. Suspendisse pretium neque congue auctor consequat. Nulla tincidunt justo tortor, volutpat placerat nisl pharetra vitae. Cras rhoncus ante et leo commodo fermentum. In consequat elit tristique orci scelerisque pretium. Pellentesque placerat at tortor et vehicula. Praesent egestas efficitur auctor. Suspendisse vel finibus lectus. Maecenas ligula leo, aliquam non odio et, tincidunt congue nulla. Maecenas aliquam interdum erat ac convallis. In consequat elit tristique orci scelerisque pretium. Pellentesque placerat at tortor et vehicula. Praesent egestas efficitur auctor. Suspendisse vel finibus lectus. Maecenas ligula leo, aliquam non odio et, tincidunt congue nulla. Maecenas aliquam interdum erat ac convallis.In consequat elit tristique orci scntesque placerat at tortor et vehicula. Praesent egestas efficitur auctor. Suspendisse vel finibus lectus. Maecenas ligula leo, aliquam non odio et, tincidunt congue nulla. Maecenas aliquam interdum erat ac convallis. </p>

              <p> In dignissim feugiat gravida. <em>Proin feugiat quam sed gravida fringilla.</em> Proin quis mauris ut magna fringilla vulputate quis non ante. Integer bibendum velit dui. Sed co <mark>et posuere eros</mark> rhoncus dapibus vulputate. Phasellus eget fringilla justo. Aliquam erat volutpat. Praesent lorem nisi, vehicula fringilla rutrum facilisis, tempus sed ipsum. Mauris commodo mattis ante, at consequat lectus blandit nec. Nulla facilisi. Phasellus <small>aliquet est ac faucibus iaculis.</small> Sed non lorem in quam placerat facilisis nec eu quam. Etiam at tincidunt felis,. Nulla dictum id enim vitae fermentum. </p>

              <div class="tags clearfix">
                <a href="#">design</a>
                <a href="#">art</a>
                <a href="#">photo</a>
                <a href="#">student</a>
                <a href="#">material</a>
                <a href="#">app</a>
                <a href="#">yellow</a>
                <a href="#">light</a>
              </div>

            </div><!-- end desc -->

            <div class="blog-desc">
              <div class="post-padding">
                <div class="widget-title">
                  <h4>3 Comments</h4>
                  <hr>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="panel">
                      <div class="panel-body comments">
                        <ul class="media-list">
                          <li class="media">
                            <div class="comment">
                              <a href="#" class="pull-left">
                                <img src="../assets/upload/avatar_01.jpg" alt="" class="img-circle">
                              </a>
                              <div class="media-body">
                                <strong class="text-success">Jane Doe</strong>
                                <span class="text-muted">
                                  <small class="text-muted">6 days ago</small></span>
                                  <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, <a href="#">#some link </a>.
                                  </p>
                                  <a href="#" class="button button--aylen btn btn-sm">Reply</a>
                                </div>
                                <div class="clearfix"></div>
                              </div>
                              <ul class="media-list">
                                <li class="media">
                                  <div class="comment">
                                    <a href="#" class="pull-left">
                                      <img src="../assets/upload/avatar_02.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                      <strong class="text-success">MrAwesome</strong>
                                      <span class="text-muted">
                                        <small class="text-muted">2 days ago</small></span>
                                        <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                        </p>
                                        <a href="#" class="button button--aylen btn btn-sm">Reply</a>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <div class="comment">
                                      <a href="#" class="pull-left">
                                        <img src="../assets/upload/avatar_03.png" alt="" class="img-circle">
                                      </a>
                                      <div class="media-body">
                                        <strong class="text-success">Miss Lucia</strong>
                                        <span class="text-muted">
                                          <small class="text-muted">15 minutes ago</small></span>
                                          <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                          </p>
                                          <a href="#" class="button button--aylen btn btn-sm">Reply</a>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </li>
                                  </ul>
                                </li>
                                <li class="media">
                                  <div class="comment">
                                    <a href="#" class="pull-left">
                                      <img src="../assets/upload/avatar_04.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                      <strong class="text-success">Jana Cova</strong>
                                      <span class="text-muted">
                                        <small class="text-muted">12 days ago</small></span>
                                        <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet.
                                        </p>
                                        <a href="#" class="button button--aylen btn btn-sm">Reply</a>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </li>
                                  <li class="media">
                                    <div class="comment">
                                      <a href="#" class="pull-left">
                                        <img src="../assets/upload/avatar_04.png" alt="" class="img-circle">
                                      </a>
                                      <div class="media-body">
                                        <strong class="text-success">Johnatan Smarty</strong>
                                        <span class="text-muted">
                                          <small class="text-muted">1 month ago</small></span>
                                          <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.
                                          </p>
                                          <a href="#" class="button button--aylen btn btn-sm">Reply</a>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><!-- end postpager -->
                      </div><!-- end content -->

                      <div class="blog-desc">
                        <div class="contact_form">
                          <div class="widget-title">
                            <h4>Leave a Comment</h4>
                            <hr>
                          </div>

                          <div class="contact_form">
                            <form class="row">
                              <div class="col-md-4 col-sm-12">
                                <label>Name <span class="required">*</span></label>
                                <input type="text" class="form-control" placeholder="">
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" class="form-control" placeholder="">
                              </div>
                              <div class="col-md-4 col-sm-12">
                                <label>Website</label>
                                <input type="text" class="form-control" placeholder="">
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <label>Comment <span class="required">*</span></label>
                                <textarea class="form-control" placeholder=""></textarea>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                <input type="submit" value="Send Comment" class="button button--aylen btn" />
                              </div>
                            </form>
                          </div><!-- end commentform -->
                        </div><!-- end postpager -->
                      </div><!-- end content -->
                    </div><!-- end blog-wrapper -->
                  </div><!-- end blog-list row -->
                </div><!-- end content -->

                <div id="sidebar" class="col-md-3 col-sm-12">
                  <div class="widget clearfix">
                    <div class="about-widget">
                      <div class="post-media">
                        <img src="../assets/upload/me.jpg" alt="" class="img-responsive">
                      </div>

                      <div class="social-icons">
                        <ul class="list-inline">
                          <li class="facebook"><a data-tooltip="tooltip" data-placement="top" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                          <li class="google"><a data-tooltip="tooltip" data-placement="top" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                          <li class="twitter"><a data-tooltip="tooltip" data-placement="top" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                          <li class="linkedin"><a data-tooltip="tooltip" data-placement="top" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                          <li class="pinterest"><a data-tooltip="tooltip" data-placement="top" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                          <li class="skype"><a data-tooltip="tooltip" data-placement="top" title="Skype" href="#"><i class="fa fa-skype"></i></a></li>
                        </ul>
                      </div><!-- end social icons -->

                      <div class="about-desc">
                        <h4>John BRITTO</h4>
                        <small>Junior Web Designer</small>
                        <p>Welcome to my portfolio, my name is John. I create handcraft web design and graphic sources for beginners like me.</p>
                        <img src="../assets/upload/signature.png" alt="">
                      </div>
                    </div>
                    <!-- end about-widget -->
                  </div>
                  <!-- end widget -->

                  <div class="widget clearfix">
                    <div class="widget-title">
                      <h4>Be Social</h4>
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

                  <div class="widget clearfix">
                    <div class="widget-title">
                      <h4>Tags</h4>
                      <hr>
                    </div>
                    <div class="tags">
                      <a href="#">design</a>
                      <a href="#">art</a>
                      <a href="#">photo</a>
                      <a href="#">student</a>
                      <a href="#">material</a>
                      <a href="#">app</a>
                      <a href="#">yellow</a>
                      <a href="#">light</a>
                    </div>
                    <!-- end tags-widget -->
                  </div>
                  <!-- end widget -->
                </div><!-- end sidebar -->
              </div><!-- end row -->
  </div>
</section>
@endsection

@section('script')
@endsection