@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Billing And Receipt Statements </h3>
		</div>
	</div>

	<div class="container-fluid">
		@if(session('notice'))
			<div class="alert alert-danger">
				{{session('notice')}}
			</div>
		@endif

<div class="row">
		<div class="col-lg-6">
			<div class="card">
				
				

				<div class="table-responsive m-t-40">
					<table id="myTable" class="table table-bordered table-striped">
						
						<thead>
							<tr>
								<th>Client Name</th>
								<th>Description</th>
								<th>Total Charge</th>
								<th>Date Bill</th>
							</tr>
						</thead>
						<tbody>
							@foreach($bills as $client_name => $bill_invoices)
								@foreach($bill_invoices as $invoice_number => $data)
									<tr>
										<td>{{ $client_name }}</td>
										<td>{{  $invoice_number }}</td>
										<td>{{  number_format((float)$data['bill'], 2) }}</td>
										<td>{{  date('F j, Y', strtotime($data['billing_date'])) }}</td>
									</tr>
									
								@endforeach
							@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
	
	
</script>


		<div class="col-lg-6">
			<div class="card">
				<div class="table-responsive m-t-40">
					<table id="Table" class="table table-bordered table-striped">
						<thead>
							<tr>
								{{-- <th>Client Name</th> --}}
								<th>Description</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>


							@foreach($receipt as $b)

							<tr>

								{{-- <td>{{$b->getCredentials->user_id}}</td> --}}
								<td>{{$b->invoice_number}}</td>
								<td>{{ number_format((float)$b->amount, 2) }}</td>
								<td><span class="label label-primary">Paid</span></td>

								<td><a href='{{ url("/receipt-{$b->id}") }}' ><i class="fa fa-edit"></i> Edit</a></td>


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



@endsection