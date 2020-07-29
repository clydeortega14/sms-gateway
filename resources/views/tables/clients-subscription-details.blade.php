<div class="col-lg-12">
	<div class="card">
		<h3 class="text-primary">PostPaid Subscriptions Details</h3>

		<div class="table-responsive m-t-40">
			<table id="myTable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Client Name</th>
						<th>Invoice Number</th>
						<th>Status</th>
						<th>Monthly Payment</th>

					</tr>
				</thead>

				<tbody>

					@foreach($payment as $pay)

					@if($pay->getCredentials->subscription == 2)
					@if($pay->status == 1)
					<tr>
						<td>{{$pay->getCredentials->users->name}}</td>
						<td>{{$pay->getInvoice->invoice_number}}</td>
						<td><label class="{{ $pay->getStatus->class}}" >{{ $pay->getStatus->name}}</label></td>
						<td>{{number_format($pay->amount, 2)}}</td>
					</tr>
					@endif
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<h3 class="text-primary">Prepaid Subscriptions Details</h3>

		<div class="table-responsive m-t-40">
			<table id="Table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Client Name</th>
						<th>Invoice Number</th>
						<th>Status</th>
						<th>Date Expired</th>
					</tr>
				</thead>

				<tbody>

 					@foreach($payment as $pay)
					@if($pay->getCredentials->subscription == 1)
					<tr>
						<td>{{$pay->getCredentials->users->name}}</td>
						<td>{{$pay->getInvoice->invoice_number}}</td>
						<td><label class="{{ $pay->getStatus->class}}" >{{ $pay->getStatus->name}}</label></td>
						<td>{{$pay->date_expire->format('F j, Y')}}</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>