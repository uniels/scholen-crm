@extends('template.private')

@section('component')
	<h1>		
		<a href="{{ route('people.index') }}">
			@lang('people.title')
		</a>
		<small>@lang('template.edit')</small>
	</h1>
	<hr>
	@include('people.formedit')

@stop

@section('javascript')

@stop