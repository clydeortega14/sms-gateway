@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Edit User Information</h3>
		</div>

	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-title">

					</div>
					<form class="form-horizontal" action="{{ url('/head-office-information-update') }}" method="POST">
						@csrf
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-sm-5 control-label">Username</label>
											<div class="col-sm-12">
												<input type="text" class="form-control" name="username" value="{{ auth()->user()->username}}" readonly>
											</div>
									</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Fullname</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="user_fullname" value="{{ auth()->user()->name}}">
													</div>
											</div>



									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
											<div class="col-sm-12">
												<input type="email" class="form-control" name="user_email" value="{{auth()->user()->email}}">
											</div>
									</div>
								</div>

								<div class="col-md-4">
									@if(auth()->user()->informations == null)
										<div class="form-group">
											<label class="col-sm-4 control-label">Company</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_company">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Address</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_address">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Zip Code</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_zipcode">
												</div>
										</div>
									@else
										<div class="form-group">
											<label class="col-sm-4 control-label">Company</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_company" value="{{ auth()->user()->informations->company}}">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Address</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_address" value="{{ auth()->user()->informations->address}}">
												</div>
										</div>

										<div class="form-group">
											<label class="col-sm-4 control-label">Zip Code</label>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="user_zipcode" value="{{ auth()->user()->informations->zip_code}}">
												</div>
										</div>
									@endif
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="col-sm-7 control-label">New Password</label>
											<div class="col-sm-12">
												<input type="password" class="form-control" name="password">
											</div>
									</div>

									<div class="form-group">
										<label class="col-sm-7 control-label">Confirm Password</label>
											<div class="col-sm-12">
												<input type="password" class="form-control" name="password_confirmation">
											</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer">
							<div class="form-group">
								<div class="col-md-12">
									<button class="btn btn-info btn-sm form-control">
										<i class="fa fa-check">&nbsp;&nbsp;&nbsp;Update Information</i>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection