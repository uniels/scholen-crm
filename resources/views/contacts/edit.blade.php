@extends('template.private')

@section('component')
	<h1>
		
		<a href="{{ route('people.index') }}">
			@lang('contacts.title')
		</a>: {{ $contact->display }}
		<small>@lang('template.edit')</small>
	</h1>
	<hr>
	@include('contacts.formedit')
@stop

@section('javascript')

@stop