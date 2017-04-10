@extends('layouts.master')

@section('head')

@stop

@section('title')
    Manage Faculty
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Manage Faculty</a>
    </li>
@stop

@section('content')
<div class="row">
	<div class="col-md-5">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box blue-dark">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="font-white"></i>
	                <span class="uppercase">List of Faculties</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                        	<th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Faculty Name </th>
	                            <th> Faculty Code </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
							<?php $count = 1; ?>
	                        @foreach($faculties as $faculty)
	                        <?php $currentPageTotalNumber = ($faculties->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="faculty_id[]" form="form_update_status" value="{{ $faculty->id }}"> </td>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $faculty->name }}</td>
	                            <td> {{ $faculty->code }}</td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	            <div class="row">
		        	<div class="col-md-6">
		        		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@deleteFaculty'], 'id'=>'form_update_status']) !!}
		        			<button class="btn btn-sm btn-danger deleteBtn">Delete</button>
		        		{!! Form::close() !!}
		        	</div>
		        	<div class="col-md-6">
		        		<div class="pull-right">
		        			{{$faculties->render()}}
		        		</div>
		        	</div>
		        </div>
	        </div>

	        
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	</div>
	

    <div class="col-md-7">
    	<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box blue-dark">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="font-white"></i>
	                <span class="uppercase">Create New Faculty</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'AdminController@createFaculty']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Faculty Name</label>
				            <div class="col-md-8">
				                    <input type="text" name="name" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Faculty Code</label>
				            <div class="col-md-8">
				                    <input type="text" name="code" class="form-control input-line">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <button class="btn btn-transparent blue btn-circle active"> Submit </button>
				        </div>
				    {!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
    </div>
    
</div>
@stop

@section('script')

<script>
	$(document).ready(function(){
       $('#checkall-checkbox').click(function(){
            if(this.checked){
                $('.checker').find('span').addClass('checked');
                $("input.single-checkbox").prop('checked', true).show();
            }
            else{
                $('.checker').find('span').removeClass('checked');
                $("input.single-checkbox").prop('checked', false);
            }
       });
    });

</script>

@if(Session::has('create_message'))
    <script>
    	alertify.success("{{Session::get('create_message')}}");
    </script>
@endif

@if(Session::has('delete_message'))
    <script>
    	alertify.warning("{{Session::get('delete_message')}}");
    </script>
@endif

@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop