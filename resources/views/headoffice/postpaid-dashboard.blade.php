<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-8">
						<h1>Postpaid</h1>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<legend  style="color:red;"><span><img src="images/pesored.png" style="height: 25px; width: 20px;">
								</span>{{number_format($in->count * $pay->getCredentials->text_rate, 2)}}</legend>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8">
								<p>Total Charges</p>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>

@include('headoffice.sms-summary-table')