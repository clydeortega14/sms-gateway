<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-6">

					</div>


					<div class="col-md-6">

						<div class="right" align="right">
							@foreach($user_payments as $payment)
								<a href='{{ url("/view_pdf/invoice/invoice{$payment->id}")}}' target="_blank" class="btn btn-info btn-sm">{{-- <i class="fa fa-file f-s-35"></i> --}}View Invoice</a>
							@endforeach
            			</div>

					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Descripion</th>
									<th>Date</th>
									<th>Amount</th>
									<th>Quantity</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>{{ $pay->invoice_number }}</td>
									<td>{{ $pay->date_expire->format('F j, Y') }}</td>
									<td>{{ $pay->invoices->total_charges }}</td>
									<td>1</td>
								</tr>
							</tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td align="right"><strong>Total (Php:) </strong><i>{{ $pay->invoices->total_charges }}</i></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>