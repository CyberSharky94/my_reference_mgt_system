@extends('employee_management.base')
@section('action-content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Employee
					</div>

					<div class="panel-body">
			<form class="form-horizontal" method="POST" action="{{ route('employee.update',['id'=>$employees->id]) }}" enctype="multipart/form-data">

        	{{ csrf_field() }}
        	{{ method_field('PUT') }}

        	<div class="form-group{{ $errors->has('firstname') ? 'has error':'' }}">
        		<label for="firstname" class="col-md-4 control-label">First name</label>

        		<div class="col-md-6">
        			<input type="text" name="firstname" id="firstname" class="form-control" value="{{ $employees->firstname }}">
        		
        			@if($errors->has('firstname'))
        				<span class="help-block">
        					<strong>{{ $errors->first('firstname') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('lastname') ? 'has error':'' }}">
        		<label for="lastname" class="col-md-4 control-label">Last Name</label>

        		<div class="col-md-6">
        			<input type="text" name="lastname" id="lastname" class="form-control" value="{{ $employees->lastname }}">
        		
        			@if($errors->has('lastname'))
        				<span class="help-block">
        					<strong>{{ $errors->first('lastname') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>


        	<div class="form-group{{ $errors->has('middlename') ? 'has error':'' }}">
        		<label for="middlename" class="col-md-4 control-label">Middle Name</label>

        		<div class="col-md-6">
        			<input type="text" name="middlename" id="middlename" class="form-control" value="{{ $employees->middlename }}">
        		
        			@if($errors->has('middlename'))
        				<span class="help-block">
        					<strong>{{ $errors->first('middlename') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('address') ? 'has error':'' }}">
        		<label for="address" class="col-md-4 control-label">Address</label>

        		<div class="col-md-6">
        			<input type="text" name="address" id="address" class="form-control" value="{{ $employees->address }}">
        		
        			@if($errors->has('address'))
        				<span class="help-block">
        					<strong>{{ $errors->first('address') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>


        	<div class="form-group{{ $errors->has('country_id') ? 'has error':'' }}">
        		<label for="country_id" class="col-md-4 control-label">Country</label>

        		<div class="col-md-6">
        			<select class="form-control" name="country_id">
        				@foreach($countries as $country)
        				<option {{ $employees->country_id == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>

        				@endforeach
        			</select>
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('age') ? 'has error':'' }}">
        		<label for="address" class="col-md-4 control-label">Age</label>

        		<div class="col-md-6">
        			<input type="text" name="age" id="age" class="form-control" value="{{ $employees->age }}">
        		
        			@if($errors->has('age'))
        				<span class="help-block">
        					<strong>{{ $errors->first('age') }}</strong>
        				</span>
        			@endif
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('birthdate') ? 'has error':'' }}">
        		<label for="birthdate" class="col-md-4 control-label">Birthday</label>

        		<div class="col-md-6">
        			<div class="input-group date">
        				<div class="input-group-addon">
        					<i class="fa fa-calendar"></i>
        				</div>
        				<input type="text" value="{{ date('d/m/Y',strtotime($employees->birthdate)) }}" name="birthdate" class="form-control pull-right" id="birthDate" required>

        			</div>
        			
        		</div>
        	</div>

        	<div class="form-group{{ $errors->has('	date_hired') ? 'has error':'' }}">
        		<label for="date_hired" class="col-md-4 control-label">Hired Date</label>

        		<div class="col-md-6">
        			<div class="input-group date">
        				<div class="input-group-addon">
        					<i class="fa fa-calendar"></i>
        				</div>
        				<input type="text" value="{{ date('d/m/Y',strtotime($employees->date_hired)) }}" name="date_hired" class="form-control pull-right" id="dateHired" required>

        			</div>
        			
        		</div>
        	</div>


        	<div class="form-group{{ $errors->has('	picture') ? 'has error':'' }}">
        		<label for="date_hired" class="col-md-4 control-label">Picture</label>

        		<div class="col-md-6">
        			<img src="{{ asset('storage/'.$employees->picture) }}" width="50px" height="50px">
        			<input type="file" id="picture" name="picture">
        			
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