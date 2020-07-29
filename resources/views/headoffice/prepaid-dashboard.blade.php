			<div class="row">
				<div class="col-md-4">
					<div class="card p-30">
						<div class="media">

							<div class="media-left media media-middle">
								<span><img src="images/pesogreen.png" style="height: 42px; width: 40px;"></span>
							</div>
							<div class="media-body media-text-right">
								<h1>{{ number_format((float)$pay->amount, 2) }}</h1>
								<p class="m-b-0">Total Credit</p>
							</div>

						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card p-30">
						<div class="media">

							<div class="media-left media media-middle">
								<span><i class="fa fa-credit-card f-s-42 color-success"></i></span>
							</div>
							<div class="media-body media-text-right">

								<h1>{{ number_format((float)$pay->getCredentials->text_rate * $in->count, 2) }}</h1>
								<p class="m-b-0">Debit</p>
							</div>

						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card p-30">
						<div class="media">

							<div class="media-left media media-middle">
								<span><i class="fa fa-balance-scale f-s-42 color-danger"></i></span>
							</div>
							<div class="media-body media-text-right">

								<h1>{{ number_format((float)$pay->amount - ($pay->getCredentials->text_rate * $in->count), 2) }}</h1>
								<p class="m-b-0">Remaining Credit</p>
							</div>

						</div>
					</div>
				</div>
			</div>

			@include('headoffice.sms-summary-table')
