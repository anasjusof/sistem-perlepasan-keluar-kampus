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
	                <span class="caption-subject font-white sbold uppercase">Histori Perlepasan Pensyarah</span>
	            </div>
	        </div>
	        <div class="portlet-body">
	            <div class="table-scrollable table-bordered table-hover">
	                <table class="table table-hover table-light">
	                    <thead>
	                        <tr class="uppercase">
	                            <th> # </th>
	                            <th> Nama Pensyarah </th>
	                            <th> Email </th>
	                            <th> Sebab </th>
	                            <th> Tarikh Keluar </th>
	                            <th> Tarikh Pulang </th>
	                            <th> Fail </th>
	                            <!-- <th> Tarikh Permohonan </th> -->
	                            <th> Status </th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody id="tbody">
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
	                        	<td> {{ $history->name }} </td>
	                        	<td> {{ $history->email }} </td>
	                            <td> {{ $history->reason }}</td>
	                            <td> {{ $history->date_from }}</td>
	                            <td> {{ $history->date_to }}</td>
	                            <td>
		                            <a class="btn btn-transparent grey-mint btn-sm active" href="{{ $directory.$history->filepath }}" download>
		                            	Download
		                            </a>
	                            </td>
	                            <!-- <td> {{ $history->created_at }}</td> -->
	                            <td>
	                                <span 
	                                	class="label min-width-100px
	                                	@if ($history->approval_status == 0){{ 'label-default' }}
	                                	@elseif ($history->approval_status == 1){{ 'label-success' }}
	                                	@else {{ 'label-danger' }}
	                                	@endif">

	                                	@if ($history->approval_status == 0){{ 'Dalam Proses' }}
	                                	@elseif ($history->approval_status == 1){{ 'Diluluskan' }}
	                                	@else {{ 'Tidak diterima' }}
	                                	@endif

	                                </span>
	                            </td>
	                            <td>
	                            	<div class="icheck-list">
										<label class="mt-radio mt-radio-outline">
                                            <input type="radio" value="{{ $history->history_id }}-1" name="history[{{ $history->history_id }}]" form="form_update_status"> Lulus
                                            <span></span>
                                        </label>
                                        <label class="mt-radio mt-radio-outline">
                                            <input type="radio" value="{{ $history->history_id }}-2" name="history[{{ $history->history_id }}]" form="form_update_status"> Tolak
                                            <span></span>
                                        </label>
									</div>
	                            </td>
	                        </tr>
	                        <?php $count++ ?>
	                        @endforeach
	                        @endif
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    </div>
	    <!-- END BORDERED TABLE PORTLET-->
	    <div class="row">
        	<div class="col-md-6">
        		{{$histories->render()}}
        	</div>
        	<div class="col-md-6">
        		<div class="pull-right">
        			
        			{!! Form::open(['method'=>'POST', 'action'=>['DeansController@approveReject'], 'id'=>'form_update_status']) !!}
        			<button class="btn btn-sm green updateBtn">Update Status</button>
        		{!! Form::close() !!}
        		</div>
        	</div>
        </div>
	</div>

    
</div>
@stop

@section('script')

<script src="../../assets/global/plugins/icheck/icheck.min.js"></script>

<script src="../../assets/admin/pages/scripts/form-icheck.js"></script>

<script> FormiCheck.init();  </script>

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


@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop