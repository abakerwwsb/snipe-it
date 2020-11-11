@extends('layouts/default')

@section('title0')
 All Racks
@stop

{{-- Page title --}}
@section('title')
@yield('title0')  @parent
@stop

@section('header_right')
  <a href="#" style="margin-right: 5px;" class="btn btn-default">
    Empty Button</a>
  <a href="#" class="btn btn-primary pull-right"></i> Empty Button</a>
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p>Racks with assets assigned</p>
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
</div>
@stop

@section('moar_scripts')
@include('partials.bootstrap-table')

@stop
