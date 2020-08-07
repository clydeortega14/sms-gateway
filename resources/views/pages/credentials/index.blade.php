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
				<div class="col-sm-12">
					<div class="card">
						<div class="card-title">
							<a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Add new credential">
                                <i class="fa fa-plus"></i>
                            </a>
						</div>

						<div class="card-body">
							@foreach($client->credentials as $credential)
								<h3 class="text-center">APP NAME</h3>
								<hr>
								<br>
								<div class="form-group row mt-3">
									<label for="staticEmail" class="col-sm-1 col-form-label">APP ID:</label>
								    <div class="col-sm-10">
								      <div class="input-group mb-3">
										  <input type="text" class="form-control" readonly value="{{ $credential->app_id }}">
										  	<div class="input-group-append">
										    	<button class="btn btn-light" type="button">
										    		<i class="fa fa-copy"></i>
										    	</button>
										  	</div>
										</div>
								    </div>
								</div>

								<div class="form-group row mt-3">
									<label for="staticEmail" class="col-sm-1 col-form-label">APP SECRET:</label>
								    <div class="col-sm-10">
								      <div class="input-group mb-3">
										  <input type="text" class="form-control" readonly value="{{ $credential->app_secret }}">
										  	<div class="input-group-append">
										    	<button class="btn btn-light" type="button">
										    		<i class="fa fa-copy"></i>
										    	</button>
										  	</div>
										</div>
								    </div>
								</div>

								<div class="form-group row mt-3">
									<label for="staticEmail" class="col-sm-1 col-form-label">PASSPHRASE:</label>
								    <div class="col-sm-10">
								      <div class="input-group mb-3">
										  <input type="text" class="form-control" readonly value="{{ $credential->passphrase }}">
										  	<div class="input-group-append">
										    	<button class="btn btn-light" type="button">
										    		<i class="fa fa-copy"></i>
										    	</button>
										  	</div>
										</div>
								    </div>
								</div>

								<div class="form-group row mt-3">
									<label for="staticEmail" class="col-sm-1 col-form-label">SHORT CODE:</label>
								    <div class="col-sm-10">
								      <div class="input-group mb-3">
										  <input type="text" class="form-control" readonly value="{{ $credential->short_code }}">
										  	<div class="input-group-append">
										    	<button class="btn btn-light" type="button">
										    		<i class="fa fa-copy"></i>
										    	</button>
										  	</div>
										</div>
								    </div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection