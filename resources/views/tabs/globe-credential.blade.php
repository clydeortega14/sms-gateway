<div class="tab-pane" id="credential" role="tabpanel">
	<div class="card-body">
		<form class="form-horizontal form-material" method="POST" action="{{ url('/add-save-credentials') }}">
			@include('includes.alert-error-message')

			@if (Session::has('msg'))
			<div class="alert alert-success alert-dismissible fade show" id="success">
				{{ Session::get('msg') }}
			</div>
			@endif

			@csrf
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">Subscriber</label>
						<div class="col-sm-12">
							<select type="combobox" name="subscriber" class="form-control">
								<option> -- Select Client -- </option>
								@foreach($clients as $client)
									<option value="{{ $client->user_id}}">{{ $client->getUser->username}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">Passphrase</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="passphrase">
						</div>
					</div>

				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">App ID</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="app_id">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label">App Secret</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="app_secret">
						</div>
					</div>

				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<center><p class="lead text-primary">Subscriptions</p></center>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-6 control-label">Subscription Type</label>
							<div class="col-sm-12">
								<select name="subscription" class="form-control" type="combobox">
									<option> -- Subscription --</option>
									@foreach($subscription as $sub)
										<option value="{{ $sub->id}}">{{ $sub->name }}</option>
									@endforeach
								</select>
							</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="col-sm-4 control-label">Text Rate</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="text_rate">
						</div>
					</div>
				</div>

			</div>
	</div>

	<div class="card-footer">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-info btn-sm form-control" type="submit">
						<i class="fa fa-check">&nbsp;Save</i>
				</button>

				</form>
			</div>
		</div>
	</div>
</div>