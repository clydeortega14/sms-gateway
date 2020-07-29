@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">{{ auth()->user()->name}} <strong>|</strong> Profile</h3>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>

			<div class="col-md-10">
				@if(session('password-response'))
					<div class="alert alert-success">
						{{ session('password-response') }}
					</div>
				@endif
			</div>

			<div class="col-md-1"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="row">
						<div class="col-md-4">
							<div class="card-title">
								@include('includes.alert-error-message')
								<center><legend class="lead text-primary">Avatar</legend><center>
							</div>
							<hr>

							<div class="card-body">
								<center>
									@foreach($informations as $fetch)
										@if(auth()->user()->informations->image == null)
											<img src="" style="border-radius: 50%;height:200px;width: 200px;">
										@else
											<img src="{{ asset('storage/uploads/'.auth()->user()->informations->image) }}" style="border-radius: 50%;height:200px;width: 200px;">
										@endif

									@endforeach
								</center>
									<form class="form-material form-horizontal" action="{{ url('/upload-image') }}" method="POST" enctype="multipart/form-data">
										@csrf

										<div class="form-group">
											<center><label class="col-sm-7 control-label">Select Picture:</label></center>

												<div class="col-sm-12">
													<center><input type="file" name="image" id="FileToUpload"></center>
												</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<input type="submit" value="Upload" class="btn btn-sm btn-danger form-control" name="submit">
											</div>
										</div>
									</form>

							</div>
						</div>

						<div class="col-md-8">
							<div class="card-title">
								<legend class="lead text-primary">User Account</legend>
							</div>
							<hr>

							<div class="card-body">
								<div class="row">
									<div class="col-md-3">

										<p>Full Name</p><br>
										<p>Username</p><br>
										<p>Email</p><br>
									</div>

									<div class="col-md-9">

										<p>{{ auth()->user()->name }}</p><br>
										<p>{{ auth()->user()->username }}</p><br>
										<p>{{ auth()->user()->email }}</p><br>
									</div>

								</div>
							</div>
							<br>
							<div class="card-title">
								<legend class="lead text-primary">Company Information</legend>
							</div>
							<hr>

							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										 <p>Company Name</p><br>
										 <p>Address</p><br>
										 <p>Zip Code</p><br>
									</div>

									<div class="col-md-9">
										@if(auth()->user()->informations == null)

										@else
										 <p>{{ auth()->user()->informations->company }}</p><br>
										 <p>{{ auth()->user()->informations->address }}</p><br>
										 <p>{{ auth()->user()->informations->zip_code }}</p><br>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4"></div>

						<div class="col-md-4"></div>

						<div class="col-md-4">
							<div class="pull-right">
								<a href="/head-office-information-edit" class="btn btn-info btn-sm">Edit Profile</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection