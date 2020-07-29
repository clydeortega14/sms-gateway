@extends('partial.master')
@section('body')
	<div class="page-wrapper">
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-primary">History</h3>
			</div>
		</div>

		<div class="container-fluid">

			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-title">

						</div>

						<div class="card-body">
							<h3 class="text-primary">Billing Statement</h3>
							<table  class="table table">
								<thead>
									<tr>
										<th>Description</th>
										<th>Date</th>
										<th>Amount</th>
										<th></th>
										<th></th>
									</tr>
								</thead>

								<tbody>

									@foreach($bills as $bill)
										@php
											$amount = $bill->total_count * $bill->getCredential->text_rate;
										@endphp
										<tr>
											<td>{{ $bill->invoice->invoice_number }}</td>
											<td>{{ $bill->created_at->format('F j, Y') }}</td>
											<td>{{ number_format($amount, 2) }}</td>
											<td></td>
											<td>
												<a href="{{ url('/view_pdf/invoice/postpaid-invoice/'.$bill->invoice->id) }}" target="_blank"><i class="fa fa-file f-s-35"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="card">
						<div class="card-title">

						</div>

						<div class="card-body">
							<h3 class="text-primary">Acknowledgement Receipt</h3>
							<table  class="table table">
								<thead>
									<tr>
										<th>Description</th>
										<th>Date</th>
										<th>Amount</th>
										<th></th>
										<th></th>
									</tr>
								</thead>

								<tbody>
									@foreach($receipts as $receipt)
										<tr>
											<td>{{ $receipt->invoice_number }}</td>
											<td>{{ $receipt->created_at->format('F j, Y') }}</td>
											<td>{{ number_format($receipt->amount, 2) }}</td>
											<td>
												<a href="{{ url('/view_pdf/receipt/postpaid-receipt/'.$receipt->id) }}" target="_blank"><i class="fa fa-file f-s-35"></i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			{{-- @foreach($payments as $payment)

				@foreach($invoice as $in)

					@foreach($credentials as $cre)

						@if($payment->status == 1)

							@if($cre->subscription == 1)

								@include('includes.main-card-billing')

								@include('includes.sub-card-billing')

							@endif

						@endif

					@endforeach

				@endforeach

			@endforeach --}}

						{{-- @include('headoffice.subscription.billing-history-table') --}}
		</div>
	</div>
@endsection