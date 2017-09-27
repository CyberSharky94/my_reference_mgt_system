@extends('system_management.country.base')
@section('action-content')
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            	<div class="col-sm-8">
            		<h3 class="box-title">List Country</h3>
            	</div>
        
                <div class="col-sm-4">
            	<a class="btn btn-primary" 
            	href="{{ route('country.create') }}">Add New Record</a>
            	</div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

            	<div class="row">
            		<div class="col-sm-6"></div>
            		<div class="col-sm-6"></div>
            	</div>

            	<form method="POST" action="{{ route('country.search') }}">
            	{{ csrf_field() }}

            	@component('layout.search',['title' => 'Search'])

            		@component('layout.cols-search-row',['items' => ['Country_Code','Name']])

            		'oldVals' => [isset($searchingVals) ? $searchingVals['country_code'] : '', isset($searchingVals) ? $searchingVals['name'] : '']

            		@endcomponent


            	@endcomponent
            	</form>



              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Country Code</th>
                  <th>Country Name</th>
                  <th>Action</th>
               
                </tr>
                </thead>
                <tbody>
                 @foreach($countries as $country)
               		<tr>
               			<td> {{ $country->country_code }} </td>
               			<td> {{ $country->name }} </td>
               			<td> 
               			 	<form class="row" method="POST" action="{{ route('country.destroy',['id'=>$country->id]) }}" onsubmit="return confirm('Are You Sure?')">
               			 		{{ csrf_field() }}
               			 		{{ method_field('DELETE') }}


               			 		<button type="submit" class="btn btn-danger col-sm-5 col-xs-5">Delete</button>

               			 		<a href="{{ route('country.edit',['id'=>$country->id]) }}" class="btn btn-warning col-sm-5 col-xs-5">Update</a>
               			 	</form>



               			</td>
               		<tr>
               	 @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Country Code</th>
                  <th>Country Name</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>

                <div class="row">
		      <div class="col-sm-5">
		      <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
		      Showing 1 to {{ count($countries) }} of {{ count($countries) }} entries
		      </div>
		      </div>
		      <div class="col-sm-7">
		      	<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
		      	{{ $countries->links() }}
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