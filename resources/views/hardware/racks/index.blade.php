@extends('layouts/default')

@section('title0')
 All Racks
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
        <h2 class="box-title">Racks with assets assigned</h2>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              @foreach ($racks as $rack)
                @if($rack->_snipeit_rack_number_18 !== NULL)
                  <p><a href="/hardware/racks/{{ $rack->_snipeit_rack_number_18 }}">Rack {{ $rack->_snipeit_rack_number_18 }} </a></p>
                @endif
              @endforeach

            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- ./box-body -->
    </div><!-- /.box -->
  </div>
  <div class="col-md-8">
    <div class="box box-default">
      <div class="box-header with-border">
        <h2 class="box-title">Rack Help</h2>
      </div>
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p>Racks are automatically displayed here if they have assets assigned to them.</p>
              <p>For the Rack fields to appear on an asset, an Asset Model needs to have the "Computer Assets (servers, desktops, etc)" fieldset.<br>
                You can create other fieldsets with the "Rack Number", "RU Location", and "RU Size" custom fields.</p>
                <p><br></p>
              <p>Click on a rack number to view the servers assigned to that rack.</p>

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
