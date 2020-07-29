@extends('partial.master')
@section('body')
<div class="page-wrapper">
			<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Bills Payment</h3>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-title">
						<center><p class="lead text-primary">Edit Payment</p></center>
					</div>
					@if (Session::has('msg'))
					<div class="alert alert-success alert-dismissible fade show" id="success">
						{{ Session::get('msg') }}
					</div>
					@endif
					<hr>
					<form class="form-horizontal" action='{{ url("/update-payment-{$receipt->id}") }}' method="POST">

						@csrf


									<div class="form-group">
										<input type="hidden" name="id" value="{{$receipt->id}}">
										<input type="hidden" name="credentials_id" value="{{$receipt->credentials_id}}">
										<input type="hidden" name="or_number" value="{{$receipt->or_number}}">
										<input type="hidden" name="status" value="{{$receipt->status}}">
									</div>

									<div class="form-group">
										<div class="col-sm-12">
										<label>Amount</label>
											<input type="text" class="form-control" name="amount" value="{{$receipt->amount}}">
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-12">
											<label>Payment Type</label>
											<input type="text" class="form-control" name="description" value="{{$receipt->description}}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<label>Remarks</label>
											<input type="text" class="form-control" name="remarks" value="{{$receipt->remarks}}">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<button class="btn btn-info btn-sm form-control" type="submit">
												<i class="fa fa-check"> &nbsp;Update Payment </i>
											</button>
										</div>
									</div>

					</form>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){
    $("#success").delay(5000).slideUp(300);
	});
</script>
@endsection
