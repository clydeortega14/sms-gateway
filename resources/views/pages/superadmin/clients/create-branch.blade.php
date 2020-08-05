@extends('partial.master')

@section('body')
	
	<div class="page-wrapper">
		<div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Create New Branch</h3>
            </div>
        </div>

        <div class="container-fluid">
        	<div class="row justify-content-center">
        		<div class="col-sm-8">
        			<div class="card">
        				<div class="card-body">
        					<form action="{{ route('store.client.branch') }}" method="POST">
        						@csrf
								
								<input type="hidden" name="client_id" value="{{ $client->id }}">

        						<div class="form-group">
        							<input type="text" name="branch_name" class="form-control" placeholder="Branch Name">
        						</div>

        						<div class="form-group">
        							<textarea type="text" name="branch_description" rows="60" cols="30" class="form-control" placeholder="Branch Description"></textarea>
        						</div>

        						<div class="form-group">
        							<button type="submit" class="btn btn-primary btn-sm">Create</button>
        							<a href="{{ route('client.branches', $client->id) }}" class="btn btn-danger btn-sm">Cancel</a>
        						</div>
        					</form>
        				</div>
        				@if(count($branches) > 0)
        					<hr>
	        				<p>There are branches that may be related to you.</p>
	        				<p>The branch/s that you will be selected will be tag to {{ $client->name }}.</p>
	        				<div class="card-body">
								<form action="{{ route('update.client.branch') }}" method="POST">
									@csrf
									
									<input type="hidden" name="client_id" value="{{ $client->id }}">
									<button class="btn btn-primary btn-sm">Tag Now</button>

		        					<div class="table-responsive">
		        						<table class="table-striped" id="myTable">
		        							<thead>
		        								<tr>
		        									<th></th>
		        									<th>Branch Name</th>
		        								</tr>
		        							</thead>

		        							<tbody>
		        								@foreach($branches as $branch)
		        								<tr>
													<td style="width: 10px;">
														<input type="checkbox" name="branch_id[]" value="{{ $branch->id}}">
													</td>
													<td style="width: 80px;">{{ $branch->branch_name }}</td>
												</tr>
		        								@endforeach
		        							</tbody>
		        						</table>
		        					</div>
	        					</form>
	        				</div>
        				@endif
        			</div>
					
        		</div>
        	</div>
        </div>
	</div>

@endsection