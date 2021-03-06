@extends($layout ? 'master::layouts/admin' : 'master::layouts/child-admin');

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/admin/css/froala.css') }}">
  @include('master::scripts.lightbox-css')
@endsection
@section('content')
  @if($pdf===false)
    {!! AdminItem::make_item_header($i, $module, $node, $action, $layout, $parent_id) !!}
    @if($action=='edit')
      @include('master::helpers.indicator-filter')
      <h3>{{ $node_name }}: {{ count($items) }} filtrados.</h3>
    @endif
  @else
    <h1>{{ $title }}</h1>
  @endif
  @if($dt!='view')
    {!! Form::open(AdminItem::make_form($module, $model, $action, $files)) !!}
  @endif
  @if(($action=='edit'||$action=='view')&&isset($parent_nodes)&&count($parent_nodes)>0)
    @include('master::includes.parent-form')
    <h4>{{ $node->singular }}</h4>
  @endif
  @include('master::includes.form')
  @if($dt!='view')
    {!! Field::form_submit($i, $model, $action) !!}
    {!! Form::close() !!}
    @include('master::helpers.activities')
  @endif
@endsection
@section('script')
  @include('master::helpers.froala')
  @include('master::scripts.child-js')
  @include('master::scripts.conditionals-js')
  @include('master::scripts.upload-js')
  @include('master::scripts.map-js')
  @include('master::scripts.map-field-js')
  @include('master::scripts.lightbox-js')
  @include('master::scripts.tooltip-js')
  @include('master::scripts.accordion-js')
  @include('master::scripts.leave-form-js')
@endsection