@extends('layouts/default')

@section('title0')
 View Rack
@stop

{{-- Page title --}}
@section('title')
@yield('title0')  @parent
@stop

@section('header_right')
  <a href="/hardware/racks" style="margin-right: 5px;" class="btn btn-default">
    View All Racks</a>
  <a href="#" class="btn btn-primary pull-right"></i> Empty Button</a>
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">Rack {{ $rackId }} - Layout</h2>
      </div>
      <div class="box-body">
          <p>Insert Rack Image Here</p>
      </div><!-- ./box-body -->
    </div><!-- /.box -->
  </div>
  <div class="col-md-8">
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">Rack {{ $rackId }} Details</h2>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
      <p>Show rack {{ $rackId }}  </p>
        @foreach ($rackData as $rackAsset)

        <h4>{{ $rackAsset->manufacturer_name }} {{ $rackAsset->model_name }} </h4>
        <p>Computer Name: {{ $rackAsset->computer_name }} </p>
        <p>Rack: {{ $rackAsset->rack_number }} </p>
        <p>Rack Unit: {{ $rackAsset->ru_location }} </p>
        <p>RU Height: {{ $rackAsset->ru_size }} </p>
        <p>Asset Tag: {{ $rackAsset->asset_tag }} </p>
        <p>Notes: {{ $rackAsset->notes }} </p>
        

        @endforeach
    </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- ./box-body -->
    </div><!-- /.box -->
  </div>
</div>
@stop

@section('moar_scripts')
@include('partials.bootstrap-table')

@stop
