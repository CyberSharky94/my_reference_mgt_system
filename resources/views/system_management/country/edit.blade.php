@extends('system_management.country.base')
@section('action-content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Country
					</div>

					<div class="panel-body">
			<form class="form-horizontal" method="POST" action="{{ route('country.update',['id'=>$countries->id]) }}">

        	{{ csrf_field() }}
        	{{ method_field('PUT') }}

        	<div class="form-group{{ $errors->has('name') ? 'has error':'' }}">
        		<label for="name" class="col-md-4 control-label">Name</label>

        		<div class="col-md-6">
        			<input type="text" name="name" id="name" class="form-control" value="{{ $countries->name }}">
        		
        			@if($errors->has('name'))
        				<span class="help-block">
        					<strong>{{ $errors->first('name') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('country_code') ? 'has error':'' }}">
        		<label for="email" class="col-md-4 control-label">Country Code</label>

        		<div class="col-md-6">
        			<input type="text" name="country_code" id="country_code" class="form-control" value="{{ $countries->country_code }}">
        		
        			@if($errors->has('country_code'))
        				<span class="help-block">
        					<strong>{{ $errors->first('country_code') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>

        
        	<div class="form-group">
        		<div class="col-md-6 col-md-offset-4">
        			<button type="submit" class="btn btn-primary">Create</button>	
        		</div>
        	</div>

        </form>
					</div>

					
				</div>
			</div>
		</div>
	</div>
	  
@endsection