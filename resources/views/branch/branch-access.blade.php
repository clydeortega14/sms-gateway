@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Create Branch Account</h3>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="card">
						<div class="card-title"></div>

						<form class="form-horizontal form-material" action="{{ url('/save-branch-access') }}" method="POST">
							@csrf
							@include('includes.alert-error-message')

							<div class="card-body">
								<div class="row">
									<div class="col-md-6">

										<div class="form-group">
											<label class="col-sm-4 control-label">Username</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="branch_username">
												</div>
												@if ($errors->has('username'))
												<span class="invalid-feedback" role="alert">
													<strong>{{ $errors->first('name') }}</strong>
												</span>
												@endif
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Email</label>
												<div class="col-sm-12">
													<input type="email" class="form-control" name="branch_email">
												</div>
												@if ($errors->has('email'))
												<span class="invalid-feedback" role="alert">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
												@endif
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Password</label>
												<div class="col-sm-12">
													<input type="password" class="form-control" name="branch_password">
												</div>
										</div>

									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="col-sm-4 control-label">Full Name</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="name">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Branch Name</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="branch_name">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Branch Code</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="branch_code">
												</div>

												@if ($errors->has('branch_id'))
												<span class="invalid-feedback" role="alert">
													<strong>{{ $errors->first('branch_id') }}</strong>
												</span>
												@endif
										</div>

										<input type="hidden" name="credentials_id" value="{{$cre_id}}">
									</div>
								</div>
							</div>

							<div class="card-footer">
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-info btn-sm form-control" type="submit">
											<i class="fa fa-check"> Submit</i>
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