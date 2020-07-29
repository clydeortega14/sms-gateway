@extends('partial.master')
@section('body')
<div class="page-wrapper">
		
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-primary">Branch Details</h3>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-md-12">
					<div class="card">
						<div class="table-responsive m-t-40">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>User</th>
										<th>Email</th>
										<th>Branch Name</th>
										<th>Address</th>
										<th>Status</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									@foreach($branchID as $branch)
										@if($branch->branch_id != auth()->user()->branch_id)
											<tr>
												<td>{{ $branch->getUser->name}}</td>
												<td>{{ $branch->getUser->email }}</td>
												<td>{{ $branch->branch_name}}</td>
												@if($branch->informations == null)
													<td></td>
												@else
													<td>{{ $branch->informations->address }}</td>
												@endif
												<td>
													@if($branch->getUser->status_id == 1)
														<p class="badge badge-success">Active</p>
													@else
														<p class="badge badge-danger">Inactive</p>
													@endif
												</td>
												<td>
													@if($branch->getUser->status_id == 1)
														<a href='{{ url("/user-status/{$branch->id}") }}' class="btn btn-sm btn-danger">Deactivate</a>
													@elseif($branch->getUser->status_id == 2)
														<a href='{{ url("/user-status/{$branch->id}") }}' class="btn btn-sm btn-success">Activate</a>
													@endif
												</td>
											</tr>

										@endif

									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

@endsection