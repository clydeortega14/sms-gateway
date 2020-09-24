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
							<a href="{{ route('add.credential', ['client_id' => $client->id ]) }}" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Add new credential">
                                <i class="fa fa-plus"></i>
                            </a>
						</div>

						<div class="card-body">

							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>App Name</th>
											<th>Passphrase</th>
											<th>App ID</th>
											<th>App Secret</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($client->credentials as $credential)
											@php
												$status = $credential->active;
											@endphp
 											<tr>
 												<td>{{ $credential->app_name }}</td>
 												<td>{{ $credential->passphrase }}</td>
 												<td>{{ $credential->app_id }}</td>
 												<td>{{ $credential->app_secret }}</td>
 												<td>
 													<span class="{{ $status == true ? 'label label-success' : 'label label-danger' }}">{{ $status == true ? 'Active' : 'Inactive' }}</span>
 												</td>
 												<td>
 													<a href="{{ route('edit.credential', ['client_id' => $client->id, 'credential_id' => $credential->id]) }}" class="btn btn-sm btn-primary">
 														<i class="fa fa-edit"></i>
 													</a> |
 													<a href="#" class="btn btn-sm {{ $status == true ? 'btn btn-success' : 'btn btn-danger' }}">
 														<i class="fa fa-reply"></i>
 													</a> |
 													<a href="#" class="btn btn-danger btn-sm">
 														<i class="fa fa-trash"></i>
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