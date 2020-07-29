@extends('partial.master')
@section('body')
<div class="page-wrapper">
			<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Bills Payment</h3>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-title">
						<center><p class="lead text-primary">Make Payment</p></center>
					</div>
					@if (Session::has('msg'))
					<div class="alert alert-success alert-dismissible fade show" id="success">
						{{ Session::get('msg') }}
					</div>
					@endif
					{{-- <hr> --}}
					<form class="form-horizontal" action="{{ url('/receipt-payment') }}" method="POST">
						@csrf

						<label>Name</label>
						<select class="form-control" name="credentials_id" required>
							<option> -- Select Client -- </option>

								@foreach($credentials as $cre)
									<option value="{{$cre->id}}">{{$cre->users->username}}</option>
								@endforeach
						</select><br>

						<div class="invoice">
							<label>Invoice No.</label>
							<select class="form-control" name="invoice_number">
								<option value="0" disabled="true" selected="true"> - Select -</option>
									@foreach($invoice as $in)
										<option value="{{$in->invoice->invoice_number}}">{{$in->invoice->invoice_number}}</option>
									@endforeach
							</select>
						
						</div>

						<label>Amount</label>
						<input type="text" class="form-control" name="amount"  required disabled>
						<br>
						<label>Payment Type</label>
						<input type="text" class="form-control" name="description" placeholder="Ex. Cash on Hand / Cheque / Bank Transfer " required>
						<br>
						<label>Remarks</label>
						<input type="text" class="form-control" name="remarks" placeholder="Ex.OR#0001" required>
						<br>
						<div class="col-md-12">
								<button class="btn btn-info btn-sm form-control" type="submit">
									<i class="fa fa-check"> &nbsp;Make Payment </i>
								</button>
						</div>	
							
					</form>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
@endsection

@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}

<script type="text/javascript">

	$(document).ready(function() {
			$(document).on('change','[name="invoice_number"]', function(){

				var invoice_number = $(this).val();
				console.log(invoice_number);
				var amount_input = $('[name="amount"]');
				
				$.ajax({
					type:'get',
					url:'{!!URL::to('findTotalUsage')!!}',
					data:{'id':invoice_number},
					success:function(amount){
						amount_input.val(amount);
						console.log(amount);
					},
					error:function(){

					}
				});
			});
	});

	// $(document).ready(function(){
 //   		 $("#success").delay(5000).slideUp(300);
	// });

</script>
@endsection
