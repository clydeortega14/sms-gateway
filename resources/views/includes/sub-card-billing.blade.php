<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-title">
				<legend align="center" style="color:#32CD32;"><span><img src="images/pesogreen.png" style="height: 25px; width: 20px;"></span> {{ number_format((float)($payment->amount), 2) }}</legend>						
			</div>

			<div class="card-body">
				<p align="center" class="lead">Total Credit</p>
			</div>
		</div>
	</div>


	<div class="col-md-1">
		<legend class="lead" align="center" style="margin-top: 50px;"> - </legend>
	</div>

	<div class="col-md-3">
		<div class="card">
			<div class="card-title">
				<legend align="center" style="color:red;"><span><img src="images/pesored.png" style="height: 25px; width: 20px;"></span> {{ number_format((float)($in->count * $cre->text_rate), 2) }}</legend>
			</div>
			<div class="card-body">
				<p align="center" class="lead">Total Charges</p>
			</div>
		</div>

	</div>

	<div class="col-md-2">
		<legend class="lead" align="center" style="margin-top: 50px;"> = </legend>
	</div>


	<div class="col-md-3">
		<div class="card">
			<div class="card-title">
				<legend align="right" style="color:#32CD32;"><span><img src="images/pesogreen.png" style="height: 25px; width: 20px;"></span> {{number_format((float)$payment->amount - ($cre->text_rate * $in->count), 2)}}</legend>
			</div>


			<div class="card-body">
				<p align="center" class="lead">Remaining Credit</p>
			</div>
		</div>
	</div>
</div>