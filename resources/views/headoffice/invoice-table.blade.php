<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-6">

					</div>



				</div>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Description</th>
									<th>Date</th>
									<th>Amount</th>
									<th>Quantity</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>{{ $pay->getInvoice->invoice_number }}</td>
									<td>{{ date('F j, Y', strtotime($pay->date_expire)) }}</td>
									<td>{{ $pay->getUsage->total_charge }}</td>
									<td>1</td>
								</tr>
							</tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td align="right"><strong>Total (Php:) </strong><i>{{ $pay->getUsage->total_charge }}</i></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>