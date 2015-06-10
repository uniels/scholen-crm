@extends('template.private')

@section('component')
	<h1> 
		<a href="{{ route('users.index') }}">
			@lang('users.title')
		</a>
		<small> @lang('template.show')</small>
	</h1>
	<hr>
	<div class="form-group">
		<div class='row'><label class="col-md-4 col-xs-6">#:</label> {{ $user->id }}</div>
		<div class='row'>
			<label class="col-md-4 col-xs-6"> @lang('template.created') </label> 
			{{ date('d F Y - G:i', strtotime($user->created_at)) }}
		</div>
		<div class='row'><label class="col-md-4 col-xs-6"> @lang('template.updated') </label> {{ strftime('%e %B %G - %H:%M', strtotime($user->updated_at)) }}</div>	
		<div class='row'><label class="col-md-4 col-xs-6"> @lang('users.username'):</label>{{ $user->username }}</div>
		<div class='row'><label class="col-md-4 col-xs-6"> @lang('users.displayname')</label>{{ $user->displayname }}</div>
	</</div>
	<a class="btn btn-default btn-primary" aria-label="@lang('template.edit')" href="{{ route('users.edit', ['id' => $user->id]) }}">
		@lang('template.edit')
	</a>
	<hr>
	<h2>@lang('contactlog.title')</h2>
		@include('contactlog.datatable',[
		'model' => 'user',
		'id'	=> $user->id
		])
@stop