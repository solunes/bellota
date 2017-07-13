@extends('layouts/master')
@include('helpers.meta')

@section('css')
  @include('helpers.page-css',['page'=>$page])
@endsection

@section('header')
<section class="section paralbackground page-banner hidden-xs" style="background-image:url('{{ asset('assets/upload/page_banner_about.jpg') }}');" data-img-width="2000" data-img-height="400" data-diff="100">
</section>
@endsection

@section('content')
<div class="page-title">
  <div class="container clearfix">
    <div class="title-area pull-left">
      <h2>{{ $page->name }} <small>Beautiful Home Decoration Materials!</small></h2>
    </div><!-- /.pull-right -->
    <div class="pull-right hidden-xs">
      <div class="bread">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">{{ $page->name }}</li>
        </ol>
      </div><!-- end bread -->
    </div><!-- /.pull-right -->
  </div>
</div><!-- end page-title -->
<section class="section lb">
  <div class="container">
    @if(count($nodes)>0)
      <div class="content-page">
        @foreach($nodes as $node_name => $node)
          <div class="content-segment content-{{ $node['node']->name }} page-{{ $node['node']->id }}">
            @if($node['node']->folder=='form')
                @include('segments.form', $node['subarray'])
            @else
              @include('segments.'.$node['node']->name, $node['subarray'])
            @endif
          </div>
        @endforeach
      </div>
    @endif
    <p><br><br><br></p>
  </div>
</section>
@endsection

@section('script')
  @include('helpers.page-script',['page'=>$page])
@endsection