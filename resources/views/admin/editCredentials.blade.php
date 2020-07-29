@extends('partial.master')
@section('body')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Globe Credential Details</h3>
		</div>
	</div>
	<div class="container-fluid">
		<div class="col-lg-12">
			<div class="card">
				<div class="table-responsive m-t-40">
					<table id="myTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Text Rate</th>
								<th>Subscription Type</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
							@foreach($credential as $cre)
							<tr>
								<td>{{$cre->name}}</td>
								<td>{{$cre->text_rate}}</td>
								<td>
									<label class="{{ $cre->getSubscription->class }}" >{{ $cre->getSubscription->name }}</label>
								</td>
								<td>
									<button class="btn  btn-primary btn-sm m-b-10 m-l-5 ">Edit</button>
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



