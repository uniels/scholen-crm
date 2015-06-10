@extends('template.private')


@section('component')
	<h1> 		
		<a href="{{ route('people.index') }}">
			@lang('people.title')
		</a>
		<small>@lang('template.create')</small>
	</h1>
	<hr>
	<section class="container">
	@include('people.formcreate')
	</section>
	
@stop