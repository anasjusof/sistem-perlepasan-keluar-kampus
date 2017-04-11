@extends('layouts.master')

@section('head')

@stop

@section('title')
    Manage Admin
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Manage Admin</a>
    </li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box blue-dark">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class=""></i>
	                <span class="uppercase">List of Users</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                <table class="table table-hover table-light">

			        	<div class="col-md-12">
			        		<a href="" class="btn btn-sm green-jungle pull-right" id="createButton" data-toggle="modal" data-target="#createModal">Create New User</a>
			        	</div>
	                    <thead>
	                        <tr class="uppercase">
	                        	<th> <input id="checkall-checkbox" type="checkbox"> </th>
	                            <th> # </th>
	                            <th> Name </th>
	                            <th> Email </th>
	                            <th> Role </th>
	                            <th> Faculty </th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
							<?php $count = 1; ?>
	                        @foreach($users as $user)
	                        <?php $currentPageTotalNumber = ($users->currentPage() - 1) * 5; ?>
	                        <tr>
	                        	<td> <input class="single-checkbox" type="checkbox" name="users_id[]" form="form_update_status" value="{{ $user->id }}"> </td>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $user->name }}</td>
	                            <td> {{ $user->email }}</td>
	                            <td> {{ $user->role_name }}</td>
	                            <td> 
	                            	@if($user->faculties_id == 0)
	                            		-
	                            	@else
	                            		{{ $user->faculty_name }}
	                            	@endif
	                            </td>
	                            <td> <a href="" class="btn blue btn-sm editBtn" data-toggle="modal" data-target="#editModal" data-user_id="{{ $user->id }}" data-username="{{ $user->name }}" data-user_email="{{ $user->email }}" data-roles_id="{{ $user->roles_id }}" data-faculties_id="{{ $user->faculties_id }}">Edit</a>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>

	            <div class="row">
		        	<div class="col-md-6">
		        		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminController@deleteUser'], 'id'=>'form_update_status']) !!}
		        			<button class="btn btn-sm btn-danger deleteBtn">Delete</button>
		        		{!! Form::close() !!}
		        	</div>
		        	<div class="col-md-6">
		        		<div class="pull-right">
		        			{{$users->render()}}
		        		</div>
		        	</div>
	        </div>

	        
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	</div>
	
	<!--
    <div class="col-md-12">
    	<!-- BEGIN BORDERED TABLE PORTLET-->
    	<!--
	    <div class="portlet box blue-dark">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class=""></i>
	                <span class="uppercase">Create New User</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'AdminController@createUser']) !!}
	                	<div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
				            <div class="col-md-8">
				                    <input type="text" name="name" class="form-control input-line" id="username" value="{{ old('name') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
				            <div class="col-md-8">
				                    <input type="email" name="email" class="form-control input-line" id="email" value="{{ old('email') }}">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Password</label>
				            <div class="col-md-8">
				            		
				                    <input type="password" name="password" class="form-control input-line" id="password">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
				            <div class="col-md-8">
				                    <input type="password" name="password_confirmation" class="form-control input-line" id="confirm_password">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Roles</label>
				            <div class="col-md-8">
				                    {!! Form::select('roles_id', $roles, 0, ['id'=>'roles_select', 'class'=>'form-control']) !!}
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Faculty</label>
				            <div class="col-md-8">
				                    {!! Form::select('faculties_id', $faculties, 0, ['id'=>'faculty_select', 'class'=>'form-control']) !!}
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <button class="btn btn-transparent blue btn-sm active submitUserBtn"> Submit </button>
				        </div>
				    {!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	  	<!--
    </div>
    
</div>
-->

<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Info</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      	{!! Form::open(['method'=>'PATCH', 'action'=>'AdminController@editUser']) !!}
      		<div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
	            <div class="col-md-8">
	                    <input type="text" name="name" class="form-control input-line" id="m_username">
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
	            <div class="col-md-8">
	                    <input type="email" name="email" class="form-control input-line" id="m_email" disabled>
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Password</label>
	            <div class="col-md-8">
	                    <input type="password" name="password" class="form-control input-line">
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
	            <div class="col-md-8">
	                    <input type="password" name="password_confirmation" class="form-control input-line">
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Roles</label>
	            <div class="col-md-8">
	                    {!! Form::select('roles_id', $roles, 0, ['id'=>'m_roles_select', 'class'=>'form-control']) !!}
	            </div>
	        </div>
	        <div class="form-group col-md-12">
	            <label for="inputPassword1" class="col-md-4 control-label">Faculty</label>
	            <div class="col-md-8">
	                    {!! Form::select('faculties_id', $faculties, 0, ['id'=>'m_faculty_select', 'class'=>'form-control']) !!}
	            </div>
	        </div>
	        <input type="hidden" name="id" id="m_user_id">
	    
	  	</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div id="createModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New User</h4>
      </div>
      <div class="modal-body">
      	<div class="table-scrollable table-scrollable-borderless">
            {!! Form::open(['method'=>'POST', 'action'=>'AdminController@createUser']) !!}
            	<div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Name</label>
		            <div class="col-md-8">
		                    <input type="text" name="name" class="form-control input-line" id="username" value="{{ old('name') }}">
		            </div>
		        </div>
		        <div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Email</label>
		            <div class="col-md-8">
		                    <input type="email" name="email" class="form-control input-line" id="email" value="{{ old('email') }}">
		            </div>
		        </div>
		        <div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Password</label>
		            <div class="col-md-8">
		            		
		                    <input type="password" name="password" class="form-control input-line" id="password">
		            </div>
		        </div>
		        <div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Confirm Password</label>
		            <div class="col-md-8">
		                    <input type="password" name="password_confirmation" class="form-control input-line" id="confirm_password">
		            </div>
		        </div>
		        <div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Roles</label>
		            <div class="col-md-8">
		                    {!! Form::select('roles_id', $roles, 0, ['id'=>'roles_select', 'class'=>'form-control']) !!}
		            </div>
		        </div>
		        <div class="form-group col-md-12">
		            <label for="inputPassword1" class="col-md-4 control-label">Faculty</label>
		            <div class="col-md-8">
		                    {!! Form::select('faculties_id', $faculties, 0, ['id'=>'faculty_select', 'class'=>'form-control']) !!}
		            </div>
		        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-transparent blue btn-sm active submitUserBtn"> Submit </button>
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
       {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<!-- End modal -->

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

       $('.editBtn').click(function(){

       		var roles_id = $(this).data('roles_id');
       		var faculties_id = $(this).data('faculties_id');

       		$("#m_user_id").val($(this).data('user_id'));
		 	$("#m_username").val($(this).data('username'));
		 	$("#m_email").val($(this).data('user_email'));
		 	$("#m_roles_select").val(roles_id);
		 	$("#m_faculty_select").val(faculties_id);
       });

       //If selected role is admin, then disabled select faculty

       $("#faculty_select").attr("disabled", true);

		$("#roles_select").change(function(){
		    if($("#roles_select").val() == '1'){
		    	$("#faculty_select").attr("disabled", true);
		    }
		    else{
		    	$("#faculty_select").attr("disabled", false);
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

@if(Session::has('update_message'))
    <script>
    	alertify.success("{{Session::get('update_message')}}");
    </script>
@endif

@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop