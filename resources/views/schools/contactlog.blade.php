@extends('template.private')

@section('component')
	<h1> 
		@lang('contactlog.title')
		<small id="relationlink">{!! $school->link() !!}</small>
	</h1>
	<hr>
	<div class="row">
		<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#contactlogcreatemodal">
		  @lang('contactlog.addnewentry')
		</button>	
	</div>
	<hr>
	<div class="row">
		@include('contactlog.datatable',[
		'model' => 'school',
		'id'	=> $school->id
		])
	</div>

	
@stop

@section('javascript')
@parent
@include('contactlog.createmodal',['contacts' => $school->contacts])
@stop