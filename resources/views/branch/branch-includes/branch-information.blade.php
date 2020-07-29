<form class="form-horizontal form-material" action="/head-office-information-saved" method="POST">
	@csrf
	<div class="panel-content">
		<div class="form-group">
			<div class="col-sm-10">
				@foreach($branches as $branch)
					<input type="hidden" class="form-control" name="branch_id" value="{{ $branch->id}}" readonly>
				
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Branch Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="branch_name" value="{{ $branch->branch_name }}" readonly>
				</div>
		</div>
				@endforeach
		<div class="form-group">
			<label class="col-sm-4 control-label">Branch Address</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="branch_address">
				</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Zip Code</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="zip_code">
				</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-2"></div>

					<div class="col-md-8">
						<div class="col-sm-10">
							<button class="btn btn-info btn-sm form-control">Submit</button>
						</div>
					</div>

				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
</form>