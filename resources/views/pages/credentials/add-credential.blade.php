@extends('partial.master')

@section('body')
	
	<div class="page-wrapper">
		<div class="row page-titles">
		    <div class="col-md-5 align-self-center">
		        <h3 class="text-primary">Credentials</h3>
		    </div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6 offset-3">
					<div class="card">
						<div class="card-body">
							<form action="#" method="POST">
								@csrf

								<input type="hidden" name="client_id" value="{{ $client->id }}">
								
								<div class="form-group">
									<label>Client</label>
									<input type="text" value="{{ $client->name}}" readonly class="form-control">
								</div>

								<div class="form-group">
									<label>passphrase</label>
									<input type="text" name="passphrase" class="form-control">
								</div>

								<div class="form-group">
									<label>App ID</label>
									<input type="text" name="app_id" class="form-control">
								</div>

								<div class="form-group">
									<label>App Secret</label>
									<input type="text" name="app_secret" class="form-control">
								</div>

								<div class="form-group">
									<label>Short Code</label>
									<input type="text" name="short_code" class="form-control">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection