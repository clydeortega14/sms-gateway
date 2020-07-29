@extends('partial.master')
@section('body')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Main Office Details</h3>
		</div>
	</div>
	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="card">
				<div class="table-responsive m-t-40">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Access Token</th>
								<th>User's Name</th>
								<th>Credential Status</th>
								<th>Subscription Type</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
							@foreach($credentials as $cre)
							<tr>
								<td>{{$cre->access_token}}</td>
								<td>{{$cre->users->name}}</td>
								<td>
									<label class="{{ $cre->getStatus->class }}" >{{ $cre->getStatus->name }}</label>
								</td>
								<td>
									<label class="{{ $cre->getSubscription->class }}" >{{ $cre->getSubscription->name }}</label>
								</td>
								<td>
									<a class="btn btn-dialog btn-primary btn-sm m-b-10 m-l-5 edit-status" href="#"><i class="fa fa-edit"></i>&nbsp;Edit</a>
									<input type="hidden" name="user_id" value="{{$cre->id}}" >
									<input type="hidden" name="status" value="{{$cre->getStatus->id}}" >
									<!-- Dialog will be inserted here -->
									<div class="awsm-dialog animated bounceIn">
										<div class="awd-content">
											<p class="awd-message">Are you sure?</p>
											<button class="btn awd-ok">Yes</button>
											<button class="btn awd-cancel">No</button>
										</div>
									</div>
									<a href='{{ url("/client-informations-{$cre->id}") }}' class="btn btn-info btn-sm m-b-10 m-l-5"><i class="fa fa-eye"></i>&nbsp; View</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	@endsection
@section('script')
<script src="css/my_css/javascipt.js"></script>
@endsection



