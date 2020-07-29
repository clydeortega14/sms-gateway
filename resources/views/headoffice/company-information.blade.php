@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Company Information</h3>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>

			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<div class="panel panel-default">
							<div class="panel-heading">
								<center><h4 style="padding:10px;" class="text-primary">INFORMATION</h4></center>
								<hr>
							</div>
							
							@include('includes.alert-error-message')
							
							@if(auth()->user()->hasRole('head_office'))

								@include('headoffice.headoffice-includes.headoffice-form-information')

							@elseif(auth()->user()->hasRole('branch'))

								@include('branch.branch-includes.branch-information')

							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-2"></div>
		</div>
	</div>
	
</div>

@endsection