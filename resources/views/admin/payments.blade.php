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
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="card">
					<div class="card-title">
						@if(session('message'))
							<div class="alert alert-success">
								{{ session('message')}}
							</div>
						@endif
					</div>
					{{-- <hr> --}}
					<form class="form-horizontal" action="{{ url('/payments-save') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Name</label>
										<div class="col-sm-12">
											<select class="form-control" name="credentials_id" required>
												<option> -- Select Client -- </option>
												@foreach($credentials as $cre)
													<option value="{{$cre->id}}">{{$cre->users->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Date Started</label>
										<div class="col-sm-12">
											<input type="date" class="form-control" name="date_start" >
										</div>
									</div>
									<div class="form-group">
										<label>Date Expiration (Note:For Prepaid Only)</label>
										<div class="col-sm-12">
											<input type="date" class="form-control" name="date_expire" >
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Amount</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" name="amount" required>
										</div>
									</div>

									<div class="form-group">
										<label>Description</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" name="description" required>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-info btn-sm form-control" type="submit">
										<i class="fa fa-check"> &nbsp;Make Payment </i>
									</button>
								</div>
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
