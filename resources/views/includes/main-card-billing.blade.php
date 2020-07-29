<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-4">
						<h1>Billing</h1>

					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<legend align="right" style="color:red;"><span><img src="images/pesored.png" style="height: 25px; width: 20px;"></span>{{ number_format((float)($in->count * $cre->text_rate), 2) }}</legend>		
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<p align="right">Total Charges</p>
							</div>
						</div>

					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<legend align="right" style="color:#32CD32;"><span><img src="images/pesogreen.png" style="height: 25px; width: 20px;"></span> {{number_format((float)$payment->amount - ($cre->text_rate * $in->count), 2)}}</legend>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<p align="right" >Remaining Credit</p>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
