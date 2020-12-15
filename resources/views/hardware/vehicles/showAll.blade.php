@extends('layouts/default')

@section('title0')
 All Vehicles
@stop

{{-- Page title --}}
@section('title')
@yield('title0')  @parent
@stop

@section('header_right')
  <a href="/hardware/vehicles" style="margin-right: 5px;" class="btn btn-warning">
    View Only Active Vehicles</a>
@stop

{{-- Page content --}}
@section('content')

<style>
  .vehicleRow14 {
    font-size: 14px;
    font-style: italic;
  }
  .vehicleRow16 {
    font-size: 16px;
  }
  .vehicleRow18 {
    font-size: 18px;
  }
  .vehicleRow20 {
    font-size: 20px;
  }
  .vehicleRowStatus {
    font-size: 16px;
    font-weight:100!important;
  }
  .col1half{width: 4.166666665%;}
  .col1{width: 8.33333333%;}
  .col2{width: 16.66666666%;}
  .col3{width: 24.99999999%;}
  .col4{width: 33.33333332%;}
  .col5{width: 41.66666665%;}
  .col6{width: 49.99999998%;}
  .col7{width: 58.33333331%;}
  .col8{width: 66.66666664%;}
  .col9{width: 74.99999997%;}
  .col10{width: 83.3333333%;}
  .col11{width: 91.66666663%;}
  .col12{width: 99.99999996%;}
  
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box box-default">

      <div class="box-body" style="padding-top:0px!important">
          <div class="row">
            <div class="col-md-12">

              <table class="table table-striped" style="margin-bottom:0px!important">
                <thead>
                  <tr>
                    <th class="col1half" scope="col" style="text-align: center;">Vehicle</th>
                    <th class="col1" scope="col">Status</th>
                    <th class="col1" scope="col">Assigned To</th>
                    <th class="col3" scope="col">Model Name</th>
                    <th class="col3" scope="col">Notes</th>
                    <th class="col1" scope="col">Actions</th>
                    <th class="col1" scope="col" style="text-align: center;">License Plate</th>
                    <th class="col1" scope="col" style="text-align: center;">VIN Number</th>
                  </tr>
                </thead>
                <tbody>

            @foreach ($vehicles as $vehicle)
                  <tr>
                    @if($vehicle->status_name == "Ready to Deploy" && !empty($vehicle->user_first_name))
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><span class="label label-primary" style="vertical-align:25%!important;"><strong>{{ $vehicle->vehicle_number }}</strong></span></a></td>
                        <td class="vehicleRowStatus col1"><span class="label label-primary">Deployed</span></td>
                    @elseif($vehicle->status_name == "Ready to Deploy")
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><span class="label label-success" style="background-color: #067945!important;vertical-align:25%!important;"><strong>{{ $vehicle->vehicle_number }}</strong></span></a></td>
                        <td class="vehicleRowStatus col1"><span class="label label-success" style="background-color: #067945!important;">Ready to Deploy</span></td>
                    @elseif($vehicle->status_name == "Out for Repair")
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><span class="label label-danger" style="vertical-align:25%!important;"><strong>{{ $vehicle->vehicle_number }}</strong></span></a></td>
                        <td class="vehicleRowStatus col1"><span class="label label-danger">Out for Repair</span></td>
                        @elseif($vehicle->status_name == "Needs Repair")
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><span class="label label-danger" style="background-color: #861811!important;vertical-align:25%!important;"><strong>{{ $vehicle->vehicle_number }}</strong></span></a></td>
                        <td class="vehicleRowStatus col1"><span class="label label-danger" style="background-color: #861811!important;">Needs Repair</span></td>
                    @elseif($vehicle->status_name == "Needs Repair Deployable")
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><span class="label label-warning" style="background-color: #ce820a!important;vertical-align:25%!important;"><strong>{{ $vehicle->vehicle_number }}</strong></span></a></td>
                        <td class="vehicleRowStatus col1"><span class="label label-warning" style="background-color: #ce820a!important;">Needs Repair</span></td>
                    @else
                        <td class="vehicleRow20 col1half" style="text-align: center;"><a href="/hardware/{{ $vehicle->asset_id }}"><strong>{{ $vehicle->vehicle_number }}</strong></a></td>
                        <td class="vehicleRow14 col1">{{ $vehicle->status_name }}</td>
                    @endif

                    @if($vehicle->user_first_name !== NULL)
                        <td class="vehicleRow18 col1"><a href="/users/{{ $vehicle->user_id }}"><span class="label label-primary"><strong>{{ $vehicle->user_first_name }} {{ $vehicle->user_last_name }}</strong></span></a></td>
                    @else
                        <td class="vehicleRow18 col1"><a href="/users/{{ $vehicle->user_id }}"><span><strong>{{ $vehicle->user_first_name }} {{ $vehicle->user_last_name }}</strong></span></a></td>
                    @endif

                    <td class="vehicleRow14col3"><a href="/hardware/{{ $vehicle->asset_id }}" >{{ $vehicle->model_name }}</a></td>

                    <td class="vehicleRow14col3">{{ $vehicle->asset_notes }}</td>

                    @if($vehicle->user_first_name !== NULL)
                        <td class="vehicleRow18 col1">
                          <a href="/hardware/{{ $vehicle->asset_id }}/checkin" class="btn btn-sm bg-purple" style="background-color: #3f3c77!important;" data-tooltip="true" title="Check this item in so it is available for re-imaging, re-issue, etc.">Checkin</a>
                          <a href="http://10.103.8.15/hardware/{{ $vehicle->asset_id }}/edit" class="btn btn-sm btn-warning" style="background-color: #ce820a!important;" data-tooltip="true" title="Update Item">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <span class="sr-only">Update</span>
                          </a>
                        </td>
                    @else
                        <td class="vehicleRow18 col1">
                          <a href="/hardware/{{ $vehicle->asset_id }}/checkout" class="btn btn-sm bg-maroon" style="background-color: #b1174f!important;" data-tooltip="true" title="Check this item out">Checkout</a>
                          <a href="http://10.103.8.15/hardware/{{ $vehicle->asset_id }}/edit" class="btn btn-sm btn-warning" style="background-color: #ce820a!important;" data-tooltip="true" title="Update Item">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <span class="sr-only">Update</span>
                          </a>
                        </td>
                    @endif

                    <td class="vehicleRow18 col1" style="font-size: 16px;text-align: center;font-family: monospace;"><strong>{{ $vehicle->license_plate }}</strong></td>
                    <td class="vehicleRow16 col1" style="font-size: 16px;text-align: center;font-family: monospace;"><em>{{ $vehicle->vin_number }}</em></td>
                  </tr>
            @endforeach

                </tbody>
              </table>

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
