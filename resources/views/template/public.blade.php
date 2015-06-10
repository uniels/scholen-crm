@extends('template.basic')

@section('mainbar')
    <p>I'm public</p>
@stop

@section('content')
	<article>
		@yield('component')
	</article>
@stop