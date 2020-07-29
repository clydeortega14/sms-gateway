<br>
<div class="tab-pane active" id="client" role="tabpanel">
	<div class="card-body">
		<form class="form-horizontal form-material" action="{{ url('/save-client-access') }}" method="POST">
			@include('includes.alert-error-message')

			@if (Session::has('message'))
			<div class="alert alert-success alert-dismissible fade show" id="success">
				{{ Session::get('message') }}
			</div>
			@endif
			
			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-5 control-label">Cooperative Name</label>
						<div class="col-sm-12">
							<input type="text" name="coop_name" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Username</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="username">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">Email</label>
						<div class="col-sm-12">
							<input type="email" class="form-control" name="email">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Password</label>
						<div class="col-sm-12">
							<input type="password" class="form-control" name="password">
						</div>
					</div>
				</div>
			</div>
	</div>

	<div class="card-footer">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-info btn-sm form-control" type="submit">
					<i class="fa fa-check"> Create Account</i>
				</button>
			</div>
		</div>

		</form>
	</div>
</div>