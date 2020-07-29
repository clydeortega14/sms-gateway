@extends('partial.master')
@section('body')
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-primary">Add New Clients</h3>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>

			<div class="col-md-10">
				<div class="card">
					<ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#client" role="tab">Client Account</a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#credential" role="tab">Globe Credential</a> </li>
                    </ul>

                    <div class="tab-content">

                    	@include('tabs.client-account')

                    	@include('tabs.globe-credential')
                    	
                    </div>

				</div>
			</div>

			<div class="col-md-1"></div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function(){
    $("#success").delay(5000).slideUp(300);
	});
</script>
@endsection