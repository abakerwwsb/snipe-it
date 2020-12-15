<link rel="stylesheet" href="http://10.103.8.15/css/dist/all.css?id=6e3b75006f2b19d69f37">
<link rel="stylesheet" href="http://10.103.8.15/css/dist/skins/skin-blue.css?id=9fa704134cfacfacab93">
<link rel="stylesheet" href="http://10.103.8.15/css/dist/bootstrap-table.css?id=1e77fde04b3f42432581">
<style>
  body {
      font-family: "Arial, Helvetica", sans-serif;
  }

  @page {
      size: letter;
      margin: 5mm 5mm 5mm 5mm;  
  }
  .print-logo {
      max-height: 40px;
  }
</style>

<div class="row">

    @if ($snipeSettings->logo_print_assets=='1')
      @if ($snipeSettings->brand == '3')
        <h2 style="text-align: center">
          @if ($snipeSettings->logo!='')
          <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
          @endif
          {{ $snipeSettings->site_name }}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 18px;">{{ $request->note }}</span>
        </h2>
      @elseif ($snipeSettings->brand == '2')
        @if ($snipeSettings->logo!='')
          <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        @endif
        @else
          <h2>{{ $snipeSettings->site_name }}</h2>
        @endif
    @endif

</div>

<div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        
        <div class="box-body" style="padding-top:0px!important">
          
            <div class="row">
              <div class="col-md-12">

                <table class="table table-striped" style="margin-bottom:0px!important">
                  <thead>
                    <tr>
                      <th class="col1" scope="col">Model Name</th>
                      <th class="col1" scope="col">Serial</th>
                      <th class="col1" scope="col">Asset Tag</th>
                      {{-- <th class="col3" scope="col">Asset Notes</th> --}}
                      <th class="col5" scope="col">Barcode</th>
                    </tr>
                  </thead>
                  <tbody>
  
              @foreach ($barcodes as $barcode)
                    <tr>
                      <td class="vehicleRow14col1">{{ $barcode->model_name }}<br><em>{{ $barcode->manufacturer_name }} - {{ $barcode->model_model_number }}</em></td>
                      <td class="vehicleRow14col1">{{ $barcode->asset_serial }}</td>
                      <td class="vehicleRow14col1"><strong>{{ $barcode->asset_tag }}</strong></td>
                      {{-- <td class="vehicleRow14col3">{{ $barcode->asset_notes }}</td> --}}
  
                      {{-- <td class="vehicleRow14col5"><img src="/hardware/{{ $barcode->asset_id }}/barcode" style="max-height: 30px; padding-top:20px; padding-bottom:20px;"></td> --}}
                      <td class="vehicleRow14col5"><img src="/hardware/{{ $barcode->asset_id }}/qr_code_asset"></td>

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


  <script src="http://10.103.8.15/js/dist/all.js?id=5dc677546cc6d86e605d" nonce=""></script>
  <script src="http://10.103.8.15/js/dist/bootstrap-table.js?id=58d95c93430f2ae33392"></script>