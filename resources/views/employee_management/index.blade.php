@extends('employee_management.base')
@section('action-content')
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            	<div class="col-sm-8">
            		<h3 class="box-title">List Employee</h3>
            	</div>
        
                <div class="col-sm-4">
            	<a class="btn btn-primary" 
            	href="{{ route('employee.create') }}">Add New Record</a>
            	</div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

            	<div class="row">
            		<div class="col-sm-6"></div>
            		<div class="col-sm-6"></div>
            	</div>

            	<form method="POST" action="{{ route('employee.search') }}">
            	{{ csrf_field() }}

            	@component('layout.search',['title' => 'Search'])

            		@component('layout.cols-search-row',['items' => ['First_Name','Country_Name']])

            		'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['country_name'] : '']

            		@endcomponent


            	@endcomponent
            	</form>


              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Picture</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th>Age</th>
                  <th>Birth date</th>
                  <th>Hired Date</th>
                  <th>Action</th>
               
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
      	 			<tr>
      	 				<td><img src="{{ asset('storage/'.$employee->picture) }}" width="50px" height="50px"></td>
      	 				<td>{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</td>
      	 				<td>{{ $employee->address }}</td>
      	 				<td>{{ $employee->country_name }}</td>
      	 				<td>{{ $employee->age }}</td>
      	 				<td>{{ date('d/m/Y', strtotime($employee->birthdate) ) }}</td>
      	 				<td>{{ date('d/m/Y', strtotime($employee->date_hired) )  }}</td>
      	 				<td>
      	 					<form class="row" method="POST" action="{{ route('employee.destroy',['id'=>$employee->id]) }}" onsubmit="return confirm('Are You Sure?')">
      	 						{{ csrf_field() }}
      	 						{{ method_field('DELETE') }}


      	 						<button type="submit" class="btn btn-danger col-sm-5 col-xs-5">Delete</button>

      	 						<a href="{{ route('employee.edit',['id'=>$employee->id]) }}" class="btn btn-warning col-sm-5 col-xs-5">Update</a>
      	 					</form>
      	 				</td>
      	 			</tr>

      	 		@endforeach       
                </tbody>
                <tfoot>
                <tr>
                  <th>Picture</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th>Age</th>
                  <th>Birth date</th>
                  <th>Hired Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>

              <div class="row">
		      <div class="col-sm-5">
		      <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
		      Showing 1 to {{ count($employees) }} of {{ count($employees) }} entries
		      </div>
		      </div>
		      <div class="col-sm-7">
		      	<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
		      	{{ $employees->links() }}
		      </div>
		      </div>
		 </div>

          
            </div>


            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->


      </div>

     
      <!-- /.row -->
    </section>
@endsection