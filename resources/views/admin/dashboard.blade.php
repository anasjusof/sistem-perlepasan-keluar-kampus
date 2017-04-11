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
	<div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-group"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="">{{ count($admin) }}</span>
                    </div>
                    <div class="desc"> Admin </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="">{{ count($dekan) }}</span></div>
                    <div class="desc"> Dekan </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-user"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="">{{ count($ketuajabatan) }}</span>
                    </div>
                    <div class="desc"> Ketua Jabatan </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="">{{ count($pensyarah) }}</span></div>
                    <div class="desc"> Pensyarah </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue-madison" href="{{ route('admin.manage-user') }}">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="89"></div>
                    <div class="desc"> Goto Users Management </div>
                </div>
            </a>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green-jungle" href="{{ route('admin.manage-faculty') }}">
                <div class="visual">
                    <i class="fa fa-institution"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="89"></div>
                    <div class="desc"> Goto Faculties Management </div>
                </div>
            </a>
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

@include('errors.validation-errors')
@include('errors.validation-errors-script')

@stop