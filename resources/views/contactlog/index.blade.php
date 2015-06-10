@extends('template.private')

@section('component')
	<h1>@lang('contactlog.title')</h1>
	<hr>
	<div class="row">
		@include('contactlog.datatable')
	</div>

@stop

@section('javascript')

@stop