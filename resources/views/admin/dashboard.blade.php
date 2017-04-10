@extends('layouts.master')

@section('head')

@stop

@section('title')
    Dashboard
@stop

@section('breadcrumb')
    <li>
        <i class="fa fa-home"></i>
        <a href="">Home</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="#">Dashboard</a>
    </li>
@stop

@section('content')
	Dashboard
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

@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop