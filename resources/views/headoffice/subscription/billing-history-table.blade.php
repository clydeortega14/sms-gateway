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
									<a href='#' target="_blank"><i class="fa fa-file f-s-35"></i></a>
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
									<a href='#' target="_blank"><i class="fa fa-file f-s-35"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- OLD CODE FOR BILLING STATEMENT -->

	{{-- @foreach($user_payment as $payment)
		@foreach($credentials as $credential)
	          @if($credential->subscription == 1)
	          <tr>
	          	@if($payment->status == 2)
		              	<td>{{ $payment->getInvoice->invoice_number }}</td>
		              	<td>{{ $payment->date_expire->format('F j, Y') }}</td>
		              	<td>{{ number_format((float)$payment->getUsage->total_charge,2) }}</td>
		              	<td></td>
		              	<td>
		              		<a href='{{ url("/view_pdf/invoice/prepaid-invoice/{$payment->getInvoice->id}") }}' target="_blank"><i class="fa fa-file f-s-35"></i></a>
		              	</td>
	          	@endif
	          </tr>
			@endif
		@endforeach

	
			@if($payment->status == 2)
			<tr>
				<td>{{ $payment->getInvoice->invoice_number }}</td>
				<td>{{ $payment->date_expire->format('F j, Y') }}</td>
				<td>@if( $payment->getUsage->total_charge > $payment->amount )
				{{ number_format((float)$payment->getUsage->total_charge,2) }}
				@else
					{{number_format((float)$payment->amount,2)}}
				@endif</td>
				<td></td>
				<td>
					<a href='{{ url("/view_pdf/invoice/postpaid-invoice/{$payment->getInvoice->id}") }}' target="_blank"><i class="fa fa-file f-s-35"></i></a>
				</td>
				<tr>
			@endif
	
	@endforeach --}}


<!-- END OLD CODE FOR BILLING STATEMENT -->


<!--  Ackknowlegment receipt Old code  -->
		{{-- @foreach($user_payment as $payment)
			@foreach($credentials as $credential)
	              @if($credential->subscription == 1)
			<tr>
				<td>{{ $payment->invoice_number }}</td>
				<td>{{ $payment->created_at->format('F j, Y')}}</td>
				<td>{{ number_format((float)$payment->amount, 2) }}</td>
				<td>{{ $payment->getReceipt->remarks }}</td>
				<td>
					<a href='{{ url("/view_pdf/payment/payment/{$payment->id}") }}' target="_blank"><i class="fa fa-file f-s-35"></i></a>
				</td>
			</tr>
				@endif
			@endforeach
		@endforeach

		@foreach($receipt as $r)
		<tr>

			<td>{{$r->invoice_number}}</td>
			<td>{{ $r->created_at->format('F j, Y') }}</td>
			<td>{{ number_format((float)$r->amount,2) }}</td>
			<td>
				
			</td>
		</tr>
		@endforeach --}}

<!-- End Acknowledgement receipt  -->
