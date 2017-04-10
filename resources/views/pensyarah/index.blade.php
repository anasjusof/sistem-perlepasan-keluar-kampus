@extends('layouts.master')

@section('head')

@stop

@section('title')
    Permohonan Perlepasan
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Histori Permohonan Perlepasan</a>
    </li>
@stop

@section('content')
<div class="row">
	
	<div class="col-md-12">
		<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box blue-dark">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-white"></i>
	                <span class="caption-subject font-white sbold uppercase">Histori Perlepasan Keluar</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-bordered table-hover">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                            <th> # </th>
	                            <th> Sebab </th>
	                            <th> Tarikh Keluar </th>
	                            <th> Tarikh Pulang </th>
	                            <th> Fail </th>
	                            <th> Tarikh Permohonan </th>
	                            <th> Status </th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<!--
	                        <tr>
	                            <td> 1 </td>
	                            <td> Zakat Fitrah </td>
	                            <td> 03-03-2017 </td>
	                            <td> <button class="btn btn-transparent yellow-lemon btn-circle btn-sm active"> Download </button> </td>
	                            <td>
	                                <span class="label label-success"> Approved </span>
	                            </td>
	                        </tr>
							-->
							<?php $count = 1; ?>
							@if(count($histories) > 0)
	                        @foreach($histories as $history)
	                        <?php $currentPageTotalNumber = ($histories->currentPage() - 1) * 5; ?>
	                        <tr>
	                            <td>{{$count + $currentPageTotalNumber}}</td>
	                            <td> {{ $history->reason }}</td>
	                            <td> {{ $history->date_from }}</td>
	                            <td> {{ $history->date_to }}</td>
	                            <td>
		                            <a class="btn btn-transparent purple btn-circle btn-sm active" href="{{ $directory.$history->filepath }}" download>
		                            	Download
		                            </a>
	                            </td>
	                            <td> {{ $history->created_at }}</td>
	                            <td>
	                                <span 
	                                	class="label min-width-100px
	                                	@if( $history->head_department_approval_status == 2) {{ 'label-danger' }}
	                                	@elseif ($history->approval_status == 0){{ 'label-default' }}
	                                	@elseif ($history->approval_status == 1){{ 'label-success' }}
	                                	@else {{ 'label-danger' }}
	                                	@endif">

	                                	@if( $history->head_department_approval_status == 2) {{ 'Tidak diterima' }}
	                                	@elseif ($history->approval_status == 0){{ 'Dalam Proses' }}
	                                	@elseif ($history->approval_status == 1){{ 'Diluluskan' }}
	                                	@else {{ 'Tidak diterima' }}
	                                	@endif

	                                </span>
	                            </td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                        @endif
	                    </tbody>
	                </table>
	            </div>
	        </div>
	        	<div class="col-md-12">
	        		<div class="text-center">
	        			{{$histories->render()}}
	        		</div>
	        	</div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	</div>

	<div class="col-md-8 col-md-offset-2">
    	<!-- BEGIN BORDERED TABLE PORTLET-->
	    <div class="portlet box blue-dark ">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="icon-calendar font-white"></i>
	                <span class="uppercase">Permohonan Perlepasan</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-scrollable-borderless">
	                {!! Form::open(['method'=>'POST', 'action'=>'LecturerController@applyLeave', 'files'=>true]) !!}
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Sebab Keluar</label>
				            <div class="col-md-8">
				                    <textarea name="reason" class="form-control border-grey-navy" rows="5" placeholder="Nyatakan sebab untuk keluar kampus" value="{{ old('reason') }}"></textarea>
				            </div>
				        </div>
				        
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Tarikh Keluar</label>
				            <div class="col-md-8">
				                <div class="input-group input-medium date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
				                	<span class="input-group-btn">
				                        <button class="btn default" type="button">
				                            <i class="fa fa-calendar"></i>
				                        </button>
				                    </span>
				                    <input type="text" class="form-control" readonly="" name="date_from" value="{{ old('date_from') }}">
				                </div>
				            </div>
				        </div>

				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Tarikh Pulang</label>
				            <div class="col-md-8">
				                <div class="input-group input-medium date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
				                	<span class="input-group-btn">
				                        <button class="btn default" type="button">
				                            <i class="fa fa-calendar"></i>
				                        </button>
				                    </span>
				                    <input type="text" class="form-control" readonly="" name="date_to" value="{{ old('date_to') }}">
				                    
				                </div>
				            </div>
				        </div>
				        
				        <div class="form-group col-md-12">
				            <label for="inputPassword1" class="col-md-4 control-label">Upload fail</label>
				            <div class="col-md-8">
				                <input class="form-control input-line input-medium" type="file" name="attachment" id="fileToUpload">
				            </div>
				        </div>
				        <div class="form-group col-md-12">
				            <button type="submit" class="btn btn-transparent blue active"> Submit </button>
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

@if(Session::has('message'))
    <script>
    	swal(
		  '',
		  "{{Session::get('message')}}",
		  'success'
		)
    </script>
@endif


@include('errors.validation-errors')

@stop