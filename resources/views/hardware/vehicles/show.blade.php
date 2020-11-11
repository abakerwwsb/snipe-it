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
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-4">
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">Test</h2>
      </div>
      <div class="box-body">


      </div><!-- ./box-body -->
    </div><!-- /.box -->
  </div>
  <div class="col-md-8">
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">TEEEEST</h2>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
                <div id="server-more-info">
                    <p>Click a server on the left to show more information  </p>
                </div>
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
