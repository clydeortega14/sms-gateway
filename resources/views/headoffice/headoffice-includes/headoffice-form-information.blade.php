<form class="form-horizontal form-material" action="/head-office-information-saved" method="POST">
	@csrf
	<div class="panel-content">
		<div class="form-group">
			<div class="col-sm-10">
				@foreach($branches as $branch)
					<input type="hidden" class="form-control" name="branch_id" value="{{ $branch->id}}" readonly>
				@endforeach
			</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 control-label" align="right">Company Name</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="company_name">
				</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 control-label" align="right">Company Address</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="company_address">
				</div>
		</div>

		<div class="form-group row">
			<label class="col-sm-4 control-label" align="right">Zip Code</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="zip_code">
				</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-info btn-sm form-control">Submit</button>
				</div>
			</div>
		</div>
	</div>
</form>
