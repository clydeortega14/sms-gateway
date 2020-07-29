<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-8">
						<h1>Postpaid Billing</h1>

					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
									<legend align="right" style="color:red;"><span><img src="images/pesored.png" style="height: 25px; width: 20px;">
									@foreach($get as $g)
									</span>{{number_format($g->count * $payment->getCredentials->text_rate, 2)}}</legend>
									@endforeach
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<p align="right">Total Charges</p>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>