@extends('partial.master')

@section('body')

<div class="page-wrapper">
	<div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">{{ $client->name }} Branches</h3>
        </div>
    </div>

    <div class="container-fluid">
    	<div class="row">
    		<div class="col-sm-12">
    			<div class="card">
    				<div class="card-header">
    					<a href="{{ route('create.branch', $client->id) }}" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Add new branch">
    						<i class="fa fa-plus"></i>
    					</a>
    				</div>
    				<div class="card-body">
    					<div class="table-responsive">
    						<table class="table table-bordered table-striped table-hover" id="myTable">
    							<thead>
    								<tr>
    									<th>Branch Name</th>
    									<th>Status</th>
    									<th></th>
    								</tr>
    							</thead>

    							<tbody>
    								@foreach($client->branches as $branch)
										<tr>
											<td>{{ $branch->branch_name }}</td>
											<td>
                                                <span class="{{ $branch->formatStatus() == 'Active' ? 'label label-success' : 'label label-danger' }}">{{ $branch->formatStatus() }}</span>
                                            </td>
											<td>
                                                <a href="" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit Branch">
                                                    <i class="fa fa-edit"></i>
                                                </a> |
                                                <a href="" class="btn btn-{{ $branch->formatStatus() == 'Active' ? 'danger' : 'success' }} btn-sm" data-toggle="tooltip" title="Update Status">
                                                    <i class="fa fa-reply"></i>
                                                </a> |

                                                <a href="" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Users">
                                                    <i class="fa fa-users"></i>
                                                </a>
                                            </td>
										</tr>
    								@endforeach
    							</tbody>
    						</table>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

@endsection