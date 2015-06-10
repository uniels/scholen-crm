@extends('template.private')


@section('component')
	<h1>@lang('template.greetings',['displayname' => $displayname ])</h1>
	<p>My Start!</p>
@stop