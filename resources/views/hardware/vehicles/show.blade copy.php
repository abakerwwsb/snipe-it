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
        <h2 class="box-title">Rack {{ $rackId }} - Layout</h2>
      </div>
      <div class="box-body">
          <div class="rack1"></div>
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
<script src="/js/allprobe.rack.widget.js"></script>

<style>

    /* ==========================================================================
       Author's custom styles
       ========================================================================== */

    .rack1{
        margin:auto;
    }
    .data_rectangle {
        margin: auto;
        border-radius: 5px;
        font-family: arial!important;
        font-weight: bold;
        padding: 5px 15px;
        border: 1px solid black;
        width: auto;
        position: absolute;
        background-color: white;
        min-width: 50px;
        min-height: 20px;
        z-index: 1000;
        display: none;
    }

    .sub_menu_rectangle {
        margin: auto;
        border-radius: 5px;
        font-family: arial!important;
        font-weight: bold;
        padding: 5px 15px;
        border: 1px solid black;
        width: auto;
        position: absolute;
        background-color: white;
        width: 210px;
        min-height: 90px;
        z-index: 1001;
        display: none;
    }
    .title_place {
        display: table;
        margin: auto;
        padding-top: 5px;
        font-weight: bold;
    }
    .rack_container {
        width: 300px;
        height: auto;
        border: 1px solid black;
        position: relative;
        margin:auto;
    }

    .rack_top {
        width: 100%;
        height: 30px;
    }

    .rack_top_corner_rect {
        width: 22px;
        height: 30px;
        background-color: #979797;
        border-bottom: 1px solid black;
        float: left;
    }

    .rack_top_middle_rect {
        width: 254px;
        height: 30px;
        border: 1px solid black;
        border-top: none;
        float: left;
        background-color: #898989;
    }

    .rack_body {
        padding-top: 1px;
        width: 100%;
        min-height: 30px;
        position: relative;
        background-color: #898989;
    }

    .rack-container-div {
        width: 80%;
        position: absolute;
        left: 40px
    }

    .rack_body_left {
        width: 20%;
        float: left;
        min-height: 13px;
        background-color: #898989;
    }

    .rack_body_middle {
        width: 80%;
        min-height: 13px;

    }

    .rack_body_right {

        width: 20%;
        float: right;
        min-height: 13px;
        background-color: #898989;
    }

    .first {
        height: 13px !important;
    }

    .single_rack {
        height: 14px;
        width: 100%;
        background-color: #cfcfcf;
        border-bottom: 1px solid #8b8b8b;
    }

    .single_rack_corner {
        width: 40px;
        height: 13px;
        background-color: #959595;
        float: left;
    }

    .single_rack_middle_section {

        width: 320px;
        height: 14px;
        border: 1px solid #cfcfcf;
        border-top: none;
        float: left;
    }

    .right {
        float: right;
    }

    .individual-server {

        height: 16px;
        border-bottom: 1px solid white;
        position: relative;
    }

    .individual-server-first {
        width: 10%;
        height: 100%;
        float: left;
        text-align: center;
        display: flex;
        /*justify-content: center;*/
        flex-direction: column;
        font-size: 11px;
    }
    
    .individual-server-first-child {
        width: 100%;
        height: 13px;
        border-bottom: 1px solid white;
        position: relative;
    }

    .rack_no {
        position: relative;
        top: 1px;
    }

    .individual-server-second {
        width: 80%;
        height: 100%;
        float: left;
        background-color: #aaa;
        text-align: center;
        display: flex;
        justify-content: center;
        flex-direction: column;
        font-size: 10px;
        font-weight: bold;
    }

    .individual-server-third {
        width: 10%;
        height: 100%;
        float: left;
    }

    .switch {
        width: 10px;
        height: 8px;
        position: absolute;
        left: 250px;
        top: 1px;
        background-color: greenyellow;
    }
    </style>
    
    <script>
    

        $(function() {
            // Pass url as a parameter.
            var data = {
                "name":"M-02 \/ 1x",
                "size":"44",
                "hosts":[
                    @foreach ($rackData as $rackAsset)
                        {"name":"{{ empty($rackAsset->computer_name) ? $rackAsset->model_name : $rackAsset->computer_name }}",
                         "size":{{ $rackAsset->ru_size }},
                         "bucket":"{{ $rackAsset->rack_number }}",
                         "ip":"{{ $rackAsset->manufacturer_name }} - {{ $rackAsset->model_name }}",
                         "events":"",
                         "submenu":"<strong>{{ $rackAsset->manufacturer_name }} - {{ $rackAsset->model_name }}</strong><br><strong>Asset Tag:</strong> <a href='/hardware/{{ $rackAsset->asset_id }}'>{{ $rackAsset->asset_tag }}</a><br><strong>Computer Name:</strong> {{ $rackAsset->computer_name }}<br><strong>Manufacturer:</strong> {{ $rackAsset->manufacturer_name }}<br><strong>Model:</strong> {{ $rackAsset->model_name }} <br><strong>Model Number:</strong> {{ $rackAsset->model_number }} <br><strong>Notes:</strong> <p style='margin-left:20px'>{!! preg_replace( '/\r|\n/', "", nl2br($rackAsset->notes) ) !!}</p>",
                         "pos":"{{ $rackAsset->ru_location }}"},
                    @endforeach
                    
                ]
            };

                $(".rack1").rack(
                    {   
                        title: "Front",
                        data: data
                    }
                );
    
    

        });
    
        
        
    </script>


@stop
