<!DOCTYPE html>
<html>
<head>
	<title>Account Report</title>

	<link rel="stylesheet" href="/css/bootstrap.min.css">

	<style>

		 * { margin: 0; padding: 0; font-family: tahoma; }
		 body { font-size:12px; }
		 p { margin: 0; /* line-height: 17px; */ }
		table { width: 100%; border: 1px solid black; border-collapse:collapse; table-layout:fixed; border-collapse: collapse; }
		th { border: 1px solid black; padding: 5px; }
		td { /*text-align: center;*/ vertical-align: center; /*padding: 5px 10px;*/ border-left: 1px solid black; color: black !important; }
		@media print {
		 	.noprint, .noprint * { display: none; }
		 }
		 a:link:after { display:none !important; }
		 .centered { margin: auto; }
		 @page{margin:10px auto !important; }
		 .rcpt-header { margin: auto; display: block; }
		 td:first-child { text-align: left; }
	
		.subsum_tr td, .netsum_tr td { border-top:1px solid black !important; border-bottom:1px solid black; }

		.hightlight_tr td {border-top: 1px solid black; border-left:0 !important; border-right: 0 !important; border-bottom: 1px solid black; background: rgb(226, 226, 226); color: black; }
		.info td {border-top: 1px solid black; border-left:0 !important; border-right: 0 !important; border-bottom: 1px solid black; background: rgb(100, 100, 100); color: black; }
		.success td {border-top: 1px solid black; border-left:0 !important; border-right: 0 !important; border-bottom: 1px solid black; background: rgb(150, 150, 150); color: black; }
		.active td {border-top: 1px solid black; border-left:0 !important; border-right: 0 !important; border-bottom: 1px solid black; background: rgb(226, 226, 226); color: black; }

		 .field {font-weight: bold; display: inline-block; width: 80px; } 
		 .voucher-table thead th {background: #ccc; padding:3px; text-align: center; font-size: 12px;} 
		 tfoot {border-top: 1px solid black; } 
		 .bold-td { font-weight: bold; border-bottom: 1px solid black;}
		 .nettotal { font-weight: bold; font-size: 14px; border-top: 1px solid black; }
		 .invoice-type { border-bottom: 1px solid black; }
		 .relative { position: relative; }
		 .signature-fields{ border: none; border-spacing: 20px; border-collapse: separate;} 
		 .signature-fields th {border: 0px; border-top: 1px solid black; border-spacing: 10px; }
		 .inv-leftblock { width: 280px; }
		 .text-left { text-align: left !important; }
		 .text-right { text-align: right !important; }
		 td {font-size: 12px; font-family: tahoma; line-height: 14px; padding: 4px;  text-transform: uppercase;} 
		 .rcpt-header { width: 450px; margin: auto; display: block; }
		 .inwords, .remBalInWords { text-transform: uppercase; }
		 .barcode { margin: auto; }
		 h3.invoice-type {font-size: 20px; width: 209px; line-height: 24px;}
		 .extra-detail span { background: #7F83E9; color: white; padding: 5px; margin-top: 17px; display: block; } 
		 .nettotal { color: red; }
		 .remainingBalance { font-weight: bold; color: blue;}
		 .centered { margin: auto; }
		 p { position: relative; }
		 .fieldvalue.cust-name {position: absolute; width: 497px; } 
		 .shadowhead { border-bottom: 1px solid black; padding-bottom: 5px; } 
	</style>
</head>
<body>
	<div class="container-fluid" style="margin-top:10px;">
		<div class="row-fluid">
			<div class="span12 centered">
				<div class="row-fluid">
					<div class="span12 centered">
						<div class="row-fluid">
							<div class="span12">
								<table class="voucher-table">
									<thead>
										<col style="width:150px;">
										<col >
										
										<tr>
											<th colspan="4">
												<h3 class="text-center shadowhead">Patient Form</h3>
											</th>
										</tr>
										<tr>
											<th style="width:150px;">Title</th>
											<th>Description</th>
											<th style="width:150px;">Title</th>
											<th>Description</th>
										</tr>
									</thead>
									<tbody id="htmlRows">
										<tr align="left">
											<td style="width:150px;">Name</td>
											<td class="txtName">{{$data['name']}}</td>
											<td style="width:150px;">Age</td>
											<td class="txtAge">{{$data['age']}}</td>
										<tr>
											<td style="width:150px;">Gender</td>
											<td class="txtGender">{{$data['gender']}}</td>
											<td style="width:150px;">Address</td>
											<td class="txtAddress">{{$data['address']}}</td>
										</tr>
										<tr>
											<td style="width:150px;">Phone Number</td>
											<td class="txtPhone">{{$data['number']}}</td>
											<td style="width:150px;">Social Information</td>
											<td class="txtSocial">{{$data['socialinfo']}}</td>
										<tr>
											<td style="width:150px;">Clinical Information</td>
											<td class="txtClinic">{{strip_tags($data['Clinicalinfo'])}}</td>
											<td style="width:150px;">Diagnosis</td>
											<td class="txtDiagonis">{{$data['diagnosis_list']}}</td>
										<tr>
											<td style="width:150px;">Investigation</td>
											<td class="txtInvestigation">{{strip_tags($data['investigation'])}}</td>
											<td style="width:150px;">General Reports</td>
											<td class="txtGeneral">{{$data['Report']}}</td>
										<tr>
											<td style="width:150px;">Next Visit</td>
											<td class="txtNVisit">{{$data['nextVisit1']}}</td>
											<td style="width:150px;">Visiting Time</td>
											<td class="txtVisiting">{{$data['timepicker']}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<br>
				<!-- <p><strong>Note:</strong>  Here please find our acount statement and check it, if any discrepancy please let it be known within a week. Otherwise it would be assumed that our statement is correct. Thanks!</p> -->
				<br>
				<div class="row-fluid">
					<div class="span12">
						<table class="signature-fields">
							<thead>
								<tr>
									<th style="border-top: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; border-bottom: 1px solid white;">Prepared By</th>
									<th style="border:1px solid white;"></th>
									<th style="border-top: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; border-bottom: 1px solid white;">Received By</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

<script type="text/javascript">
 
 window.print();

</script>
</html>