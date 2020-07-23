<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assigned to {{ $show_user->present()->fullName() }}</title>
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
		  font-size: 13px;
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
		  font-size: 13px;
		  font-weight: bold;
		}
		.table-heading{
		    margin-bottom:3px;
		}


       .signature-wrapper {
            position: relative;
            width: 50%;
            height: 150px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        img {
            position: absolute;
            left: 0;
            top: 0;
        }

        .signature-pad {
            position: absolute;
            left: 0;
            top: 0;
            width:400px;
            height:150px;
            outline: 1px groove rgba(37,147,219,0.47);
            outline-offset: 0px;        }

		.myButton {
			background:linear-gradient(to bottom, #33bdef 5%, #019ad2 100%);
			background-color:#33bdef;
			border-radius:12px;
			border:1px solid #057fd0;
			display:inline-block;
			cursor:pointer;
			color:#ffffff;
			font-family:Arial;
			font-size:14px;
			font-weight:bold;
			padding:6px 15px;
			text-decoration:none;
			margin-top:20px;
		}
		.myButton:hover {
			background:linear-gradient(to bottom, #019ad2 5%, #33bdef 100%);
			background-color:#019ad2;
		}
		.myButton:active {
			position:relative;
			top:1px;
		}

		.alert-box {
		    color:#555;
		    border-radius:10px;
		    font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
		    padding:10px 10px 10px 36px;
		    margin:10px;
		}

		.alert-box span {
		    font-weight:bold;
		    text-transform:uppercase;
		}

		.error {
		    background:#ffecec url('images/error.png') no-repeat 10px 50%;
		    border:1px solid #f5aca6;
		}
		.success {
		    background:#e9ffd9 url('images/success.png') no-repeat 10px 50%;
		    border:1px solid #a6ca8a;
		}
		.warning {
		    background:#fff8c4 url('images/warning.png') no-repeat 10px 50%;
		    border:1px solid #f2c779;
		}
		.notice {
		    background:#e3f7fc url('images/notice.png') no-repeat 10px 50%;
		    border:1px solid #8ed9f6;
		}

    </style>
</head>

<body id="print-me">

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


<p style="font-size: 10pt">I, <u>&nbsp;&nbsp;&nbsp;&nbsp;<strong> {{ $show_user->present()->fullName() }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;</u>, understand that the property described below (<em>“property”</em>) is provided to me by <strong>WWSB ABC 7</strong>, and will remain the property of the Company, its successors and assigns. I further understand that this property is provided to me for my exclusive use and I will return it to the Company when requested or should leave its employ. It is further understood that I will be responsible for the property’s safe condition and may be required to repair, replace, or pay for (through payroll deduction which I authorize by my signature below) the property in the case of loss, damage (beyond normal use), or theft. I also understand that this property is to be used exclusively in the course and pursuit of Company business and will not be used for any other purpose, personal or commercial.</p>

@if ($assets->count() > 0)
    @php
        $counter = 1;
    @endphp
    <h4 class="table-heading">Assets assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory assets-table">
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
            <td>{{ \App\Helpers\Helper::getFormattedDateObject($asset->last_checkout, 'date', false) }}</td>
        </tr>
            @php
                $counter++
            @endphp
    @endforeach
    </table>
@endif


@if ($licenses->count() > 0)
    <h4 class="table-heading">Licenses assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory licenses-table">
        <thead>
            <tr>
                <th style="width: 30%;">Name</th>
                <th style="width: 26%;">Email</th>
                <th style="width: 36%;">Serial/Product Key</th>
                <th style="width: 8%;">Checked Out</th>
            </tr>
        </thead>
        @php
        $lcounter = 1;
        @endphp

        @foreach ($licenses as $license)

            <tr>
                <td>{{ $license->name }}</td>
                <td>{{ $license->license_email }}</td>
                <td>
                    @can('viewKeys', $license)
                        {{ $license->serial }}
                    @else
                        ------------
                    @endcan
                </td>
                <td>{{  $license->assetlog->first()->created_at }}</td>
            </tr>
            @php
                $lcounter++
            @endphp
        @endforeach
    </table>
@endif


@if ($accessories->count() > 0)
    <h4 class="table-heading">Accessories assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory accessories-table">
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
    <h4 class="table-heading">Consumables assigned to {{ $show_user->present()->fullName() }}</h4>
    <table class="inventory consumables-table">
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

<p style="font-size: 10pt;">I aknowledge receipt of the items listed above, and hereby agree to the terms stated above. I also agree that This Agreement supersedes and replaces all previous Acknowledgement of Receipt and Responsibility agreements hereto relating to company provided assets.
<br>

<div class="signature-wrapper" style="float:left;">
  <canvas id="signature-pad" class="signature-pad" width=400 height=150></canvas>
</div>

<div class="signature-wrapper" style="float:right;">
  <canvas id="signature-pad2" class="signature-pad" width=400 height=150></canvas>
</div>

<div style="clear: all;"></div>


<div style="width:50%;padding-top:10px;float:left;">Employee Signature &nbsp; - &nbsp; Date: <?php echo date('M d, Y');?></div>
<div style="width:50%;padding-top:10px;float:right;">Company Representative Signature &nbsp; - &nbsp; Date: <?php echo date('M d, Y');?></div>

<div style="clear:both;"></div>

<div>
	<div class="alert-box success" id="pdfUploadAlert" style="display:none;"><span>success: </span>File Uploaded!</div>

  <button class="myButton" id="cmd">Save & Upload Responsibilty Form</button>
  <button class="myButton" id="downloadPDF">Download PDF</button>

</div>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- <script src="{{ asset('js/dist/all.js') }}"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.6/dist/jspdf.plugin.autotable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

<script nonce="{{ csrf_token() }}">
	//Employee Signature Pad
	var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
	  backgroundColor: 'rgba(255, 255, 255, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});

	//Engineering Signature Pad
	var signaturePad2 = new SignaturePad(document.getElementById('signature-pad2'), {
	  backgroundColor: 'rgba(255, 255, 255, 0)',
	  penColor: 'rgb(0, 0, 0)'
	});

	//Javascript to PDF initialization
   	var doc = new jsPDF()

	doc.setFontSize(15);
	doc.text("WWSB Inventory", 50, 15);
	doc.setFontSize(13);
	doc.text("Acknowledgement of Receipt and Responsibility", 50, 20);
	doc.text("Authorization of Payroll Deductions", 50, 25);
	doc.addImage('data:image/png;base64,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', 'PNG', 18, 9, 25, 20);
	doc.setFontSize(9);

	var acceptanceParagraph = "I, {{ $show_user->present()->fullName() }} , understand that the property described below (“property”) is provided to me by WWSB ABC 7, and will remain the property of the Company, its successors and assigns. I further understand that this property is provided to me for my exclusive use and I will return it to the Company when requested or should leave its employ. It is further understood that I will be responsible for the property’s safe condition and may be required to repair, replace, or pay for (through payroll deduction which I authorize by my signature below) the property in the case of loss, damage (beyond normal use), or theft. I also understand that this property is to be used exclusively in the course and pursuit of Company business and will not be used for any other purpose, personal or commercial."

	lines = doc.splitTextToSize(acceptanceParagraph, 200)

	doc.text(5, 35, lines)

	</script>
@if ($assets->count() > 0)
	<script>
	doc.setFontSize(12);
	doc.text("Assets assigned to {{ $show_user->present()->fullName() }}", 5, 63);

	finalY = doc.lastAutoTable.finalY || 65

	doc.autoTable({
	    startY: finalY,
	    html: '.assets-table',
	    useCss: true,
	    showHead: 'firstPage',
	    pageBreak: 'avoid',
	    margin: Margin = 5,
	})


</script>
@endif

@if ($licenses->count() > 0)
	<script>

	finalY = doc.lastAutoTable.finalY + 10;

	doc.setFontSize(12);
	doc.text("Licenses assigned to {{ $show_user->present()->fullName() }}", 5, finalY);

	finalY = doc.lastAutoTable.finalY || 60

	doc.autoTable({
	    startY: finalY + 12,
	    html: '.licenses-table',
	    useCss: true,
	    showHead: 'firstPage',
	    pageBreak: 'avoid',
	    margin: Margin = 5,
	})


</script>
@endif

@if ($accessories->count() > 0)
	<script>
	finalY = doc.lastAutoTable.finalY + 10;

	doc.setFontSize(12);
	doc.text("Accessories assigned to {{ $show_user->present()->fullName() }}", 5, finalY);

	finalY = doc.lastAutoTable.finalY || 60

	doc.autoTable({
	    startY: finalY + 12,
	    html: '.accessories-table',
	    useCss: true,
	    showHead: 'firstPage',
	    pageBreak: 'avoid',
	    margin: Margin = 5,
	})


</script>
@endif

@if ($consumables->count() > 0)
	<script>
	finalY = doc.lastAutoTable.finalY + 10;

	doc.setFontSize(12);
	doc.text("Consumables assigned to {{ $show_user->present()->fullName() }}", 5, finalY);

	finalY = doc.lastAutoTable.finalY || 60

	doc.autoTable({
	    startY: finalY + 12,
	    html: '.consumables-table',
	    useCss: true,
	    showHead: 'firstPage',
	    pageBreak: 'avoid',
	    margin: Margin = 5,
	})

</script>
@endif

<script nonce="{{ csrf_token() }}">
	finalY = doc.lastAutoTable.finalY + 10;

	doc.setFontSize(9);
	var signatureParagraph = "I aknowledge receipt of the items listed above, and hereby agree to the terms stated above. I also agree that This Agreement supersedes and replaces all previous Acknowledgement of Receipt and Responsibility agreements hereto relating to company provided assets."
	lines = doc.splitTextToSize(signatureParagraph, 200)
	doc.text(5, finalY, lines)


	$('#downloadPDF').click(function () {
		var employeeSignature = signaturePad.toDataURL(); // save image as PNG
		doc.addImage(employeeSignature, 'PNG', 5, finalY + 5, 100, 37)
		doc.rect(5, finalY + 5, 100, 37);
		doc.text("Employee Signature - Date: <?php echo date('M d, Y');?>", 5, finalY + 47)

		var engineeringSignature = signaturePad2.toDataURL(); // save image as PNG
		doc.addImage(engineeringSignature, 'PNG', 105, finalY + 5, 100, 37)
		doc.rect(105, finalY + 5, 100, 37);
		doc.text("Company Representative - Date: <?php echo date('M d, Y');?>", 105, finalY + 47);

        doc.save('two-by-four.pdf')
	});

    $('#cmd').click(function () {

    	$('button').prop('disabled', true);
    	document.getElementById("pdfUploadAlert").className = "alert-box notice";
      	$("#pdfUploadAlert").show(); // use slide down for animation

		var employeeSignature = signaturePad.toDataURL(); // save image as PNG
		doc.addImage(employeeSignature, 'PNG', 5, finalY + 5, 100, 37)
		doc.rect(5, finalY + 5, 100, 37);
		doc.text("Employee Signature - Date: <?php echo date('M d, Y');?>", 5, finalY + 47)

		var engineeringSignature = signaturePad2.toDataURL(); // save image as PNG
		doc.addImage(engineeringSignature, 'PNG', 105, finalY + 5, 100, 37)
		doc.rect(105, finalY + 5, 100, 37);
		doc.text("Company Representative - Date: <?php echo date('M d, Y');?>", 105, finalY + 47);

        //doc.save('two-by-four.pdf')

		// output as blob
		// var pdf = doc.output('blob');

		// var data = new FormData();

		// data.append('file[0]', pdf);

		// var xhr = new XMLHttpRequest();
		// xhr.onreadystatechange = function() {
		//   if (this.readyState == 4) {
		//     if (this.status !== 200) {
		//       // handle error
		//     }
		//   }
		// }

		// xhr.open('POST', 'http://10.103.8.15/users/{{ $show_user->present()->id }}/upload', true);
		// console.log(pdf);
		// xhr.send(data);


		
        //var blob = doc.output('blob');
        var blob = new Blob([ doc.output('blob') ], { type : 'application/pdf'});

        var formData = new FormData();
        formData.append('file[]', blob, "{{ $show_user->present()->fullName() }}-Responsibility.pdf");
        formData.append('notes', "{{ $show_user->present()->fullName() }} - Receipt and Responsibility - Signed <?php echo date('M d, Y - h:i:s A');?>")
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	      });
        
        $.ajax('http://10.103.8.15/users/{{ $show_user->present()->id }}/upload',
        {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
            	console.log("Success");
            	document.getElementById("pdfUploadAlert").className = "alert-box success";
            	setTimeout(function () {
			      	$("#pdfUploadAlert").slideUp(500);
		      	}, 15000);
		      	$('button').prop('disabled', false);
            },
            error: function(data){console.log("Failure")}
        });
        



    });



</script>



</body>
</html>
