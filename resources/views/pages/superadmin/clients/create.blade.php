@extends('partial.master')

@section('body')

	<div class="page-wrapper">

		<div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Create New Client</h3>
            </div>
        </div>

        <div class="container-fuid">
        	<div class="row justify-content-center">
        		<div class="col-sm-8">
        			<div class="card card-body">
						@include('alerts.alert-messages')

        				<form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST">
        					@csrf

                            @if(isset($client))
                                @method('PUT')
                            @endif

        					<div class="form-group">
        						<input type="text" name="name" value="{{ isset($client) ? $client->name : old('name') }}" class="form-control" placeholder="Client Name">
        					</div>

        					<div class="form-group">
        						<textarea type="text" name="description" rows="6" cols="50" class="form-control" placeholder="Client Description">{{ isset($client) ? $client->description : old('description') }}</textarea>
        					</div>

        					<div class="form-group">
        						<input type="email" name="email" value="{{ isset($client) ? $client->email : old('email') }}" class="form-control" placeholder="Email">
        					</div>

        					<div class="form-group">
        						<input type="number" name="contact_number" value="{{ isset($client) ? $client->contact_number : old('contact_number') }}" class="form-control" placeholder="Contact Number">
        					</div>

        					<div class="form-group">
        						<textarea type="text" name="address" rows="6" cols="50" class="form-control" placeholder="Client Address">{{ isset($client) ? $client->address : old('address') }}</textarea>
        					</div>

        					<div class="form-group">
        						<button type="submit" class="btn btn-primary btn-sm">{{ isset($client) ? 'Save Changes' : 'Create' }}</button>
        						<a href="{{ route('clients.index') }}" class="btn btn-danger btn-sm">Cancel</a>
        					</div>
        				</form>
        			</div>
        		</div>
        	</div>
        </div>

	</div>

@endsection