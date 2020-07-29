@extends('partial.master')
@section('body')
<div class="page-wrapper">

	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Dashboard Overview</h3>
		</div>
	</div>

	<div class="container-fluid">
		@if(session('notice'))
			<div class="alert alert-danger">
				{{session('notice')}}
			</div>
		@endif

		@if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
			@include('tables.clients-subscription-details')
		@endif
	</div>
</div>

@endsection
