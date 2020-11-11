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
        {{-- <pre>{{ var_dump($rackData) }}</pre> --}}
          
        <div class="rack1">
            <div class="rack_container">
                <div class="data_rectangle" style="top: 641px; left: 277.344px; display: none;">Ross Video - Frame</div>
                <div class="sub_menu_rectangle"></div>
                <div class="rack_top">
                    <div class="rack_top_corner_rect"></div>
                    <div class="rack_top_middle_rect"><span class="title_place">Front - Rack {{ $rackId }}</span></div>
                    <div class="rack_top_corner_rect"></div>
                </div>
                <div class="rack_body">
                    @php
                        $rackArray = array();
                        $multiAssetRowArray = array();
                    @endphp
                    @for ($i = "0"; $i < "44"; $i++)
                        @php
                            $assetRowLocated = FALSE;
                            $assetID = NULL;
                            $assetTag = NULL;
                            $assetSerial = NULL;
                            $assetAssignedTo = NULL;
                            $assetNotes = NULL;
                            $assetServiceTag = NULL;
                            $assetComputerName = NULL;
                            $assetRackNumber = NULL;
                            $assetRULocation = NULL;
                            $assetRUSize = NULL;
                            $assetModelName = NULL;
                            $assetModelNumber = NULL;
                            $assetManufacturerName = NULL;
                        @endphp
                        @foreach ($rackData as $rackAsset)
                            @if (is_numeric( $rackAsset->ru_location ) && floor( $rackAsset->ru_location ) != $rackAsset->ru_location)
                                @php 
                                    $assetRowExploded = explode(".",$rackAsset->ru_location)
                                @endphp
                                    @if ($assetRowExploded[0] == $i+1 )
                                        @php
                                            $assetRowLocated = FALSE;
                                            $assetID = $rackAsset->asset_id;
                                            $assetTag = $rackAsset->asset_tag;
                                            $assetName = $rackAsset->name;
                                            $assetSerial = $rackAsset->serial;
                                            $assetAssignedTo = $rackAsset->assigned_to;
                                            $assetNotes = $rackAsset->notes;
                                            $assetServiceTag = $rackAsset->service_tag;
                                            $assetComputerName = $rackAsset->computer_name;
                                            $assetRackNumber = $rackAsset->rack_number;
                                            $assetRULocation = $rackAsset->ru_location;
                                            $assetRUSize = $rackAsset->ru_size;
                                            $assetModelName = $rackAsset->model_name;
                                            $assetModelNumber = $rackAsset->model_number;
                                            $assetManufacturerName = $rackAsset->manufacturer_name;
                                        @endphp

                                        @if ($assetRUSize > 1)
                                            @php
                                                $height = 18;
                                            @endphp
                                            <?php ob_start(); ?>
                                                <div class="individual-server" index="{{ $i }}" style="height: {{ $height*$assetRUSize}}px;">
                                                    <div class="individual-server-first">
                                                        @for ($countMultiRack = $assetRUSize-1; $countMultiRack > "0"; $countMultiRack--)
                                                            <div class="individual-server-first-child" style="height:17px;background-color: green; color:#ffffff">{{ $i+$countMultiRack+1 }}</div>
                                                        @endfor
                                                        
                                                        <div class="individual-server-first-child" style="height:17px;border-bottom:none;background-color: green; color:#ffffff"><span class="rack_no">{{ $i+1 }}</span></div>
                                                    </div>
                                                    <div class="individual-server-second">
                                                        @if (!empty($assetComputerName))
                                                            <span style="cursor: pointer;">{{ $assetComputerName }}</span>
                                                        @else
                                                            <span style="cursor: pointer;">{{ $assetManufacturerName }} - {{ $assetModelName }}</span>
                                                        @endif
                                                        <div class="serverInformation">
                                                            <p><strong>{{ $assetManufacturerName }} - {{ $assetModelName }}</strong></p>
                                                            <p><strong>Asset Tag:</strong> <a href='/hardware/{{ $assetID }}'>{{ $assetTag }}</a></p>
                                                            <p><strong>Computer Name:</strong> {{ $assetComputerName }}</p>
                                                            <p><strong>Asset Name:</strong> {{ $assetName }}</p>
                                                            <p><strong>Manufacturer:</strong> {{ $assetManufacturerName }}</p>
                                                            <p><strong>Model:</strong> {{ $assetModelName }}</p>
                                                            <p><strong>Model Number:</strong> {{ $assetModelNumber }}</p>
                                                            <p><strong>Serial Number:</strong> {{ $assetSerial }}</p>
                                                            <p><strong>Service Tag:</strong> {{ $assetServiceTag }}</p>
                                                            <p><strong>Assigned To:</strong> {{ $assetAssignedTo }}</p>
                                                            <p><strong>Notes:</strong> <p style='margin-left:20px'>{!! preg_replace( '/\r|\n/', "", nl2br($assetNotes) ) !!}</p>

                                                        </div>
                                                    </div>
                                                    <div class="individual-server-third"></div>
                                                </div>
                                            <?php $rackHTML = ob_get_clean(); ?>
                                            @php
                                                $i = $i + $assetRUSize-1;
                                            @endphp
                                        @else
                                            <?php ob_start(); ?>
                                            <div class="individual-server" index="{{ $i }}" style="height: 18px;">
                                                <div class="individual-server-first">
                                                    <div class="individual-server-first-child" style="height:17px;border-bottom:none;background-color: green; color:#ffffff"><span class="rack_no">{{ $i+1 }}</span></div>
                                                </div>
                                                <div class="individual-server-second">
                                                    @if (!empty($assetComputerName))
                                                        <span style="cursor: pointer;">{{ $assetComputerName }}</span>
                                                    @else
                                                        <span style="cursor: pointer;">{{ $assetManufacturerName }} - {{ $assetModelName }}</span>
                                                    @endif

                                                    <div class="serverInformation">
                                                        <p><strong>{{ $assetManufacturerName }} - {{ $assetModelName }}</strong></p>
                                                        <p><strong>Asset Tag:</strong> <a href='/hardware/{{ $assetID }}'>{{ $assetTag }}</a></p>
                                                        <p><strong>Computer Name:</strong> {{ $assetComputerName }}</p>
                                                        <p><strong>Asset Name:</strong> {{ $assetName }}</p>
                                                        <p><strong>Manufacturer:</strong> {{ $assetManufacturerName }}</p>
                                                        <p><strong>Model:</strong> {{ $assetModelName }}</p>
                                                        <p><strong>Model Number:</strong> {{ $assetModelNumber }}</p>
                                                        <p><strong>Serial Number:</strong> {{ $assetSerial }}</p>
                                                        <p><strong>Service Tag:</strong> {{ $assetServiceTag }}</p>
                                                        <p><strong>Assigned To:</strong> {{ $assetAssignedTo }}</p>
                                                        <p><strong>Notes:</strong> <p style='margin-left:20px'>{!! preg_replace( '/\r|\n/', "", nl2br($assetNotes) ) !!}</p>
                                                    </div>
                                                </div>
                                                <div class="individual-server-third"></div>
                                            </div>
                                            <?php $rackHTML = ob_get_clean(); ?>
                                        @endif

                                    @endif

                            @elseif ($rackAsset->ru_location == $i+1)
                                @php
                                    $assetRowLocated = TRUE;
                                    $assetID = $rackAsset->asset_id;
                                    $assetTag = $rackAsset->asset_tag;
                                    $assetName = $rackAsset->name;
                                    $assetSerial = $rackAsset->serial;
                                    $assetAssignedTo = $rackAsset->assigned_to;
                                    $assetNotes = $rackAsset->notes;
                                    $assetServiceTag = $rackAsset->service_tag;
                                    $assetComputerName = $rackAsset->computer_name;
                                    $assetRackNumber = $rackAsset->rack_number;
                                    $assetRULocation = $rackAsset->ru_location;
                                    $assetRUSize = $rackAsset->ru_size;
                                    $assetModelName = $rackAsset->model_name;
                                    $assetModelNumber = $rackAsset->model_number;
                                    $assetManufacturerName = $rackAsset->manufacturer_name;
                                @endphp
                            @endif
                        @endforeach


                        @if ($assetRowLocated == FALSE)

                            <?php ob_start(); ?>
                                <div class="individual-server" index="{{ $i }}" style="height: 18px;">
                                    <div class="individual-server-first">
                                        <div class="individual-server-first-child" style="height:17px;border-bottom:none;"><span class="rack_no">{{ $i+1 }}</span></div>
                                    </div>
                                    <div class="individual-server-second"><span style="cursor: pointer;"></span></div>
                                    <div class="individual-server-third"></div>
                                </div>
                            <?php $rackHTML = ob_get_clean(); ?>

                        @else
                            @if ($assetRUSize > 1)
                                @php
                                    $height = 18;
                                @endphp
                                <?php ob_start(); ?>
                                    <div class="individual-server" index="{{ $i }}" style="height: {{ $height*$assetRUSize}}px;">
                                        <div class="individual-server-first">
                                            @for ($countMultiRack = $assetRUSize-1; $countMultiRack > "0"; $countMultiRack--)
                                                <div class="individual-server-first-child" style="height:17px;background-color: green; color:#ffffff">{{ $i+$countMultiRack+1 }}</div>
                                            @endfor
                                            
                                            <div class="individual-server-first-child" style="height:17px;border-bottom:none;background-color: green; color:#ffffff"><span class="rack_no">{{ $i+1 }}</span></div>
                                        </div>
                                        <div class="individual-server-second">
                                            @if (!empty($assetComputerName))
                                                <span style="cursor: pointer;">{{ $assetComputerName }}</span>
                                            @else
                                                <span style="cursor: pointer;">{{ $assetManufacturerName }} - {{ $assetModelName }}</span>
                                            @endif
                                            <div class="serverInformation">
                                                <p><strong>{{ $assetManufacturerName }} - {{ $assetModelName }}</strong></p>
                                                <p><strong>Asset Tag:</strong> <a href='/hardware/{{ $assetID }}'>{{ $assetTag }}</a></p>
                                                <p><strong>Computer Name:</strong> {{ $assetComputerName }}</p>
                                                <p><strong>Asset Name:</strong> {{ $assetName }}</p>
                                                <p><strong>Manufacturer:</strong> {{ $assetManufacturerName }}</p>
                                                <p><strong>Model:</strong> {{ $assetModelName }}</p>
                                                <p><strong>Model Number:</strong> {{ $assetModelNumber }}</p>
                                                <p><strong>Serial Number:</strong> {{ $assetSerial }}</p>
                                                <p><strong>Service Tag:</strong> {{ $assetServiceTag }}</p>
                                                <p><strong>Assigned To:</strong> {{ $assetAssignedTo }}</p>
                                                <p><strong>Notes:</strong> <p style='margin-left:20px'>{!! preg_replace( '/\r|\n/', "", nl2br($assetNotes) ) !!}</p>

                                            </div>
                                        </div>
                                        <div class="individual-server-third"></div>
                                    </div>
                                <?php $rackHTML = ob_get_clean(); ?>
                                @php
                                    $i = $i + $assetRUSize-1;
                                @endphp
                            @else
                            <?php ob_start(); ?>
                                <div class="individual-server" index="{{ $i }}" style="height: 18px;">
                                    <div class="individual-server-first">
                                        <div class="individual-server-first-child" style="height:17px;border-bottom:none;background-color: green; color:#ffffff"><span class="rack_no">{{ $i+1 }}</span></div>
                                    </div>
                                    <div class="individual-server-second">
                                        @if (!empty($assetComputerName))
                                            <span style="cursor: pointer;">{{ $assetComputerName }}</span>
                                        @else
                                            <span style="cursor: pointer;">{{ $assetManufacturerName }} - {{ $assetModelName }}</span>
                                        @endif

                                        <div class="serverInformation">
                                            <p><strong>{{ $assetManufacturerName }} - {{ $assetModelName }}</strong></p>
                                            <p><strong>Asset Tag:</strong> <a href='/hardware/{{ $assetID }}'>{{ $assetTag }}</a></p>
                                            <p><strong>Computer Name:</strong> {{ $assetComputerName }}</p>
                                            <p><strong>Asset Name:</strong> {{ $assetName }}</p>
                                            <p><strong>Manufacturer:</strong> {{ $assetManufacturerName }}</p>
                                            <p><strong>Model:</strong> {{ $assetModelName }}</p>
                                            <p><strong>Model Number:</strong> {{ $assetModelNumber }}</p>
                                            <p><strong>Serial Number:</strong> {{ $assetSerial }}</p>
                                            <p><strong>Service Tag:</strong> {{ $assetServiceTag }}</p>
                                            <p><strong>Assigned To:</strong> {{ $assetAssignedTo }}</p>
                                            <p><strong>Notes:</strong> <p style='margin-left:20px'>{!! preg_replace( '/\r|\n/', "", nl2br($assetNotes) ) !!}</p>
                                        </div>
                                    </div>
                                    <div class="individual-server-third"></div>
                                </div>
                            <?php $rackHTML = ob_get_clean(); ?>
                            @endif

                        @endif

                        @php
                            array_unshift($rackArray, $rackHTML);
                        @endphp
                    @endfor

                    <?php
                        foreach($rackArray as $HTMLitem){
                            echo $HTMLitem;
                        }
                    ?>


                </div>
                <div class="rack_bottom_section">
                    <div class="rack_top">
                        <div class="rack_top_corner_rect"></div>
                        <div class="rack_top_middle_rect"></div>
                        <div class="rack_top_corner_rect"></div>
                    </div>
                </div>
            </div>
        </div>

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

    .individual-server-second .serverInformation {
        display:none;
    }
    #server-more-info .serverInformation {
        display:inherit!important;
    }
    #server-more-info span {
        display:none!important;
    }
    </style>
    
    <script type="text/javascript">
    
        $(".individual-server-second").click(function(event) {
                //var firstDivContent = $(this).find('.serverInformation').get(0).innerHTML;
                var firstDivContent = $(this).get(0).innerHTML;
                console.log(firstDivContent);
                var secondDivContent = document.getElementById('server-more-info');
                console.log(secondDivContent);
                secondDivContent.innerHTML = firstDivContent;

                

            });

        function copyDiv(){
            
        }
      </script>


@stop
