@extends('layouts/master')
@include('helpers.meta')

@section('css')
  @include('helpers.page-css',['page'=>$page])
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
  <div>
    <p><br><br><br></p>
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
@endsection

@section('script')
  @include('helpers.page-script',['page'=>$page])
@endsection