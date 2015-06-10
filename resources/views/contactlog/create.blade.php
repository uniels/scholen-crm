@extends('template.private')

@section('component')
	<h1> 
		<a href="{{ route('contactlog.index') }}">
			@lang('contactlog.title')
		</a>
		<small>@lang('template.create')</small>
	</h1>
	<hr>
	<div class="row">
		@include('contactlog.formcreate')
	</div>

@stop

