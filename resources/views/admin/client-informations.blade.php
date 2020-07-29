@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Client Informations</h3>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					 <div class="card-title">
					 	<div class="row">
					 		<div class="col-md-6">
					 			<p class="text-primary">Client Account</p>
					 		</div>
					 		<div class="col-md-6">
					 			@if($clients->users->status_id == 1)
					 				<a href='{{ url("/client-account-status-{$clients->id}") }}' class="btn btn-info btn-sm pull-right">Disable Account</a>
					 			@elseif($clients->users->status_id == 2)
									<a href='{{ url("/client-account-status-{$clients->id}") }}' class="btn btn-info btn-sm pull-right">Enable Account</a>
					 			@endif
					 		</div>
					 	</div>
					 </div>
					 <hr>
					 <div class="card-body">
					 	<div class="row">
					 		<div class="col-md-6">
					 			<div class="row">
					 				<div class="col-md-4">
					 					<strong>
						 					<p style="text-align:right;">Username</p><br>
						 					<p style="text-align:right;">Full Name</p><br>
					 					</strong>
					 				</div>

					 				<div class="col-md-8">
					 					<p>{{$clients->users->username}}</p><br>
					 					<p>{{$clients->users->name}}</p><br>
					 				</div>
					 			</div>
					 			
					 		</div>

					 		<div class="col-md-6">
					 			<div class="row">
					 				<div class="col-md-3">
					 					<strong>
						 					<p style="text-align:right">Email</p><br>
						 					<p style="text-align:right">Status</p>
					 					</strong>
					 				</div>

					 				<div class="col-md-9">
					 					<p>{{$clients->users->email}}</p><br>
					 					@if($clients->users->status_id == 1)
					 						<p class="badge badge-success">{{$clients->users->status->name}}</p><br>
					 					@elseif($clients->users->status_id == 2)
					 						<p class="badge badge-danger">{{$clients->users->status->name}}</p><br>
					 					@endif
					 				</div>
					 			</div>
					 		</div>
					 	</div>
					 </div>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-title">
						<p class="text-primary">Company Information</p>
					</div>
					<hr>

					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<strong>
									<p style="text-align:right;">Company Name</p><br>
									<p style="text-align:right;">Address</p><br>
									<p style="text-align:right;">Zip Code</p><br>
								</strong>
							</div>

							<div class="col-md-8">
								@if($clients->users->information_id == null)
									<div class="col-md-8">
										<p></p><br>
										<p></p><br>
										<p></p><br>
									</div>
								@else
									<div class="col-md-8">
										<p>{{$clients->users->informations->company}}</p><br>
										<p>{{$clients->users->informations->address}}</p><br>
										<p>{{$clients->users->informations->zip_code}}</p><br>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card" style="height:293px;">
					<div class="card-title">
						<p class="text-primary">Subscribed To</p>
					</div>
					<hr>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								<strong>
									<p style="text-align:right">Subscription</p><br>
									<p style="text-align:right">Rate Per Text</p>
								</strong>
							</div>

							<div class="col-md-9">
								<form class="form-horizontal form-material" action='{{ url("/update-client-subscription-{$clients->id}") }}' method="POST">
									@csrf
									<div class="form-group">
										<div class="col-sm-10">
											<select class="form-control" name="client_sub" required>
												<option value="{{ $clients->getSubscription->id }}">{{$clients->getSubscription->name}}</option>
												<option></option>
												@foreach($subscriptions as $subscription)
													<option value="{{ $subscription->id }}">{{$subscription->name}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-10">
											<input type="text" class="form-control" name="text_rate" value="{{$clients->text_rate}}">
										</div>
									</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-info btn-sm form-control">Update</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					 <div class="card-title">
					 	<p class="text-primary">Globe Credentials</p>
					 </div>
					 <hr>
					 <div class="card-body">
					 	<div class="row">
					 		<div class="col-md-2">
					 			<strong>
						 			<p style="text-align:right">Access token </p><br>
						 			<p style="text-align:right">Passphrase</p><br> 
						 			<p style="text-align:right">App_ID</p><br>
						 			<p style="text-align:right">App_Secret</p><br>
					 			</strong>
					 		</div>

					 		<div class="col-md-10">
					 			<p>{{$clients->access_token}}</p><br>
					 			<p>{{$clients->passphrase}}</p><br>
					 			<p>{{$clients->app_id}}</p><br>
					 			<p>{{$clients->app_secret}}</p><br>
					 		</div>
					 	</div>
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection