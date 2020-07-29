<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-title">
				<div class="row">
					<div class="col-md-4"></div>

					<div class="col-md-4 color-primary">
						<center><legend>SMS SUMMARY</legend></center>
					</div>

					<div class="col-md-4"></div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive m-t-40">
					<table class="table table-stripe">
						<thead style="background: #50B8E7;">
							<tr>
								<th style="color: #fff;"><b>Branches</b></th>
								<th style="color: #fff;"><b>Total SMS</b></th>
								<th style="color: #fff;"><b>Charges</b></th>
							</tr>
						</thead>
						<tbody>
							@foreach($branch as $br)
								@foreach($credentials as $cre)
									@if(auth()->user()->hasRole('head_office'))
										@if($br->credentials_id == $cre->id)
												<tr>
													<td style="color: #000;"><b>{{ $br->branch_name }}</b></td>
													<td style="color: #000;"><b>{{ $br->count }}</b></td>
													<td style="color: #000;"><b>{{ number_format((float)$br->count * $pay->getCredentials->text_rate, 2) }}</b></td>
												</tr>
										@endif
									@elseif(auth()->user()->hasRole('branch'))
										@if(auth()->user()->id == $br->user_id)
												<tr>
													<td style="color: #000;"><b>{{ $br->branch_name }}</b></td>
													<td style="color: #000;"><b>{{ $br->count }}</b></td>
													<td style="color: #000;"><b>{{ number_format((float)$br->count * $pay->getCredentials->text_rate, 2) }}</b></td>
												</tr>
										@endif
									@endif
								@endforeach
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>