@extends('layouts/default')

@section('title0')
 Create Barcode List
@stop

{{-- Page title --}}
@section('title')
@yield('title0')  @parent
@stop

@section('header_right')
  <a href="#" style="margin-right: 5px;" class="btn bg-teal-active">
    Dummy Button</a>
@stop

{{-- Page content --}}
@section('content')

<style>
  .input-group {
    padding-left: 0px !important;
  }
</style>


<div class="row">
  <!-- left column -->
  <div class="col-md-7">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"> Select Assets </h3>
      </div>
      <div class="box-body">
        <h4>This form only allows you to select any asset and generate a page full of tiny little barcodes.</h4>
        <form class="form-horizontal" method="post" action="/hardware/barcodes/create" autocomplete="off">
          {{ csrf_field() }}


          <!-- Note -->
          <div class="form-group {{ $errors->has('note') ? 'error' : '' }}">
            {{ Form::label('note', trans('admin/hardware/form.notes'), array('class' => 'col-md-3 control-label')) }}
            <div class="col-md-8">
              <textarea class="col-md-6 form-control" id="note" name="note">{{ old('note') }}</textarea>
              {!! $errors->first('note', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
            </div>
          </div>

          @include ('partials.forms.edit.asset-select', [
            'translated_name' => trans('general.assets'),
            'fieldname' => 'selected_assets[]',
            'multiple' => true,
            'select_id' => 'barcode_assets_select',
            'asset_status_type' => 'ALL',
          ])

      </div> <!--./box-body-->
      <div class="box-footer">
        <a class="btn btn-link" href="{{ URL::previous() }}"> {{ trans('button.cancel') }}</a>
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check icon-white"></i> Generate Barcode List</button>
      </div>
    </div>
      </form>
  </div> <!--/.col-md-7-->

</div>
@stop

@section('moar_scripts')
@include('partials/assets-assigned')

@stop