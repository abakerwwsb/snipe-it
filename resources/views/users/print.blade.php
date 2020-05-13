<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Assigned to {{ $show_user->present()->fullName() }}</title>
    <style>
        body {
            font-family: "Arial, Helvetica", sans-serif;
        }

        @page {
            size: A4;
        }
        .print-logo {
            max-height: 40px;
        }

        table.inventory {
  border: 1px solid #1C6EA4;
  width: 100%;
  border-collapse: collapse;
}
table.inventory td, table.inventory th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.inventory tbody td {
  font-size: 15px;
  color: #333333;
}
table.inventory tr:nth-child(even) {
  background: #eee;
}
table.inventory thead {
    background: #D1D1D1;
  background: -moz-linear-gradient(top, #dcdcdc 0%, #d5d5d5 66%, #D1D1D1 100%);
  background: -webkit-linear-gradient(top, #dcdcdc 0%, #d5d5d5 66%, #D1D1D1 100%);
  background: linear-gradient(to bottom, #dcdcdc 0%, #d5d5d5 66%, #D1D1D1 100%);
  border-bottom: 2px solid #444444;
}
table.inventory thead th {
  font-size: 15px;
  font-weight: bold;
}
.table-heading{
    margin-bottom:3px;
}

    </style>
</head>
<body>

@if ($snipeSettings->logo_print_assets=='1')
    @if ($snipeSettings->brand == '3')

        <h2 style="text-align: center">
        @if ($snipeSettings->logo!='')
            <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        @endif
        {{ $snipeSettings->site_name }}
        </h2>
    @elseif ($snipeSettings->brand == '2')
        @if ($snipeSettings->logo!='')
            <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        @endif
    @else
      <h2>{{ $snipeSettings->site_name }}</h2>
    @endif
@endif
<h3 style="text-align: center">Acknowledgement of Receipt and Responsibility</h3>
<h3 style="text-align: center">Authorization of Payroll Deductions</h3>


<p style="font-size: 15pt;line-height: 38pt">I, <u>&nbsp;&nbsp;&nbsp;&nbsp;<strong> {{ $show_user->present()->fullName() }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;</u>, understand that the property described below (<em>“property”</em>) is provided to me by <strong>WWSB ABC 7</strong>, and will remain the property of the Company, its successors and assigns. I further understand that this property is provided to me for my exclusive use and I will return it to the Company when requested or should leave its employ. It is further understood that I will be responsible for the property’s safe condition and may be required to repair, replace, or pay for (through payroll deduction which I authorize by my signature below) the property in the case of loss, damage (beyond normal use), or theft. I also understand that this property is to be used exclusively in the course and pursuit of Company business and will not be used for any other purpose, personal or commercial.</p>

@if ($assets->count() > 0)
    @php
        $counter = 1;
    @endphp
    <h4 class="table-heading">Assets assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory">
        <thead>
            <tr>
                <th style="width: 10%;">Asset Tag</th>
                <th style="width: 18%;">Category</th>
                <th style="width: 18%;">Manufacturer</th>
                <th style="width: 18%;">Model</th>
                <th style="width: 18%;">Serial</th>
                <th style="width: 18%;">Checked Out</th>
            </tr>
        </thead>

    @foreach ($assets as $asset)

        <tr>
            <td>{{ $asset->asset_tag }}</td>
            <td>{{ $asset->model->category->name }}</td>
            <td>{{ $asset->model->manufacturer->name }}</td>
            <td>{{ $asset->model->name }}</td>
            <td>{{ $asset->serial }}</td>
            <td>{{ \App\Helpers\Helper::getFormattedDateObject($asset->last_checkout, 'prettydate', false) }}</td>
        </tr>
            @php
                $counter++
            @endphp
    @endforeach
    </table>
@endif


@if ($licenses->count() > 0)
    <br><br>
    <h4 class="table-heading">Licenses assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory">
        <thead>
            <tr>
                <th style="width: 40%;">Name</th>
                <th style="width: 50%;">Serial/Product Key</th>
                <th style="width: 10%;">Checked Out</th>
            </tr>
        </thead>
        @php
        $lcounter = 1;
        @endphp

        @foreach ($licenses as $license)

            <tr>
                <td>{{ $license->name }}</td>
                <td>
                    @can('viewKeys', $license)
                        {{ $license->serial }}
                    @else
                        ------------
                    @endcan
                </td>
                <td>{{ \App\Helpers\Helper::getFormattedDateObject($license->assetlog->first()->created_at, 'prettydate', false) }}</td>
            </tr>
            @php
                $lcounter++
            @endphp
        @endforeach
    </table>
@endif


@if ($accessories->count() > 0)
    <br><br>
    <h4 class="table-heading">Accessories assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory">
        <thead>
            <tr>
                <th style="width: 25%;">Category</th>
                <th style="width: 25%;">Manufacturer</th>
                <th style="width: 25%;">Name</th>
                <th style="width: 25%;">Model</th>
            </tr>
        </thead>
        @php
            $acounter = 1;
        @endphp

        @foreach ($accessories as $accessory)
            @if ($accessory)
                <tr>
                    <td>{{ $accessory->category->name }}</td>
                    <td>{{ !empty($accessory->manufacturer) ? $accessory->manufacturer->name:'' }}</td>
                    <td>{{ $accessory->name }}</td>
                    <td>{{ $accessory->model_number }}</td>
                </tr>
                @php
                    $acounter++
                @endphp
            @endif
        @endforeach
    </table>
@endif


@if ($consumables->count() > 0)
    <br><br>
    <h4 class="table-heading">Consumables assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory">
        <thead>
        <tr>
            <th style="width: 20px;"></th>
            <th style="width: 40%;">Name</th>
            <th style="width: 50%;">Category</th>
            <th style="width: 10%;">Checked Out</th>
        </tr>
        </thead>
        @php
            $ccounter = 1;
        @endphp

        @foreach ($consumables as $consumable)
            @if ($consumable)
                <tr>
                    <td>{{ $ccounter }}</td>


                <td>
                    @if ($consumable->deleted_at!='')
                    <td>{{ ($consumable->manufacturer) ? $consumable->manufacturer->name : '' }}  {{ $consumable->name }} {{ $consumable->model_number }}</td>
                    @else
                        {{ ($consumable->manufacturer) ? $consumable->manufacturer->name : '' }}  {{ $consumable->name }} {{ $consumable->model_number }}
                    @endif
                </td>
                    <td>{{ $consumable->category->name }}</td>
                    <td>{{  $consumable->assetlog->first()->created_at }}</td>
                </tr>
                @php
                    $ccounter++
                @endphp
            @endif
        @endforeach
    </table>
@endif

<br>
<br>
<br>
<p>I aknowledge receipt of the items listed above, and hereby agree to the terms stated above. I also agree that This Agreement supersedes and replaces all previous Acknowledgement of Receipt and Responsibility agreements hereto relating to company provided assets.
<br>
<br>
<br>
<table style="width:100%;border-collapse:separate;border-spacing:8px;">
    <tr>
        <td style="width: 70%;border-bottom:1pt solid black;">&nbsp;</td>
        <td style="width: 30%;border-bottom:1pt solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 70%;">&nbsp;&nbsp;Employee Signature</td>
        <td style="width: 30%;">&nbsp;&nbsp;Date</td>
    </tr>
</table>
<br><br><br>
<table style="width:100%;border-collapse:separate;border-spacing:8px;">
    <tr>
        <td style="width: 70%;border-bottom:1pt solid black;">&nbsp;</td>
        <td style="width: 30%;border-bottom:1pt solid black;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 70%;">&nbsp;&nbsp;Company Representative</td>
        <td style="width: 30%;">&nbsp;&nbsp;Date</td>
    </tr>
</table>


</body>
</html>
