@extends('partial.master')
@section('body')
<div class="page-wrapper">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-primary">Sent Messages</h3>
			</div>
		</div>

		<div class="container-fluid">
			<div class="col-md-12">
				<div class="card">
					<div class="card-title">
						<div class="row">
							<div class="col-md-6">
								<h3>Outbox</h3>
							</div>


						</div>
					</div>

					<div class="card-body">
						<table id="sent_messages_table" class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>Branch ID</th>
									<th>Number</th>
									<th>Message</th>
									<th width='200'>Date Sent</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection
