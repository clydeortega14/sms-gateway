@extends('partial.master')
@section('body')
<div class="page-wrapper">

	@if(auth()->user()->information_id == null)

		

	@else
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-primary">Dashboard Overview</h3>
			</div>
		</div>

					<div class="container-fluid">
			@if(session('notice'))
				<div class="alert alert-danger">
					{{ session('notice') }}
				</div>
			@endif

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-title">
							<div class="row">
								<div class="col-md-12">
									<div>
										<img src="images/postpaid-logo.png" style="width: 50%;">
										<label for="">
											<h2><b>Postpaid</b></h2>
											<legend  style="color:red;"><span><img src="images/peso.png" style="height: 25px; width: 20px;">
											</span>{{ $postpaid }}</legend>
											<p style="font-size: 30px;">Total Charges</p>
										</label>
									</div>
									
								</div>
								<!-- <div class="col-md-4">
									<div class="row">
										<div class="col-md-12">
										
										
											<legend  style="color:red;"><span><img src="images/pesored.png" style="height: 25px; width: 20px;">
											
											</span>721.59</legend>
											
										</div>
									</div>

									<div class="row">
										<div class="col-md-8">
											<p>Total Charges</p>
										</div>
									</div>
								</div> -->
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-title">
							<div class="row">
								<div class="col-md-4"></div>

								<div class="col-md-4 color-primary">
									<center><legend>SMS SUMMARY</legend></center>
								</div>

								<div class="col-md-4"></div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive m-t-40">
								<table class="table table-stripe">
									<thead style="background: #f9a643;">
										<tr>
											<th style="color: #fff;"><b>Branches</b></th>
											<th style="color: #fff;"><b>Total SMS</b></th>
											<th style="color: #fff;"><b>Charges</b></th>
										</tr>
									</thead>
									<tbody>
										@foreach($sms_summary as $sms)
											
											<tr>
												<td>{{ $sms['branch_name'] }}</td>
												<td>{{ $sms['total_sms'] }}</td>
												<td>{{ $sms['charges'] }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	@endif



</div>

@endsection