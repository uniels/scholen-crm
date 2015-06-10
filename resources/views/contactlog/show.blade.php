@extends('template.private')

@section('component')
	<h1> 
		<a href="{{ route('contactlog.index') }}">
			@lang('contactlog.title')
		</a>
		<small>@lang('contactlog.details')</small>
	</h1>
	<hr>
	@include('contactlog.show-basic')
	<div class="row">
		@include('form.fixed',[
			'model'		=> 'contactlog',
			'fieldname' => 'summary',
			'value' 	=> $contactlog->summary,
		])
	</div>
	<div class="row">
		@include('form.fixed',[
			'model'		=> 'contactlog',
			'fieldname' => 'agreements',
			'value' 	=> $contactlog->agreements?:trans('contactlog.emptyagreements'),
		])
	</div>
	<hr>
	<div class="row">
	<a href="{{ route('contactlog.edit',$contactlog) }}" class="btn btn-primary col-xs-12">@lang('template.edit')</a>
	</div>
@stop

@section('javascript')
@parent

@stop