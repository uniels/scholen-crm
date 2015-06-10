@extends('template.private')


@section('component')
	<h1> 
		<a href="{{ route('users.index') }}">
			@lang('users.title')
		</a>
		<small>@lang('template.create')</small>
	</h1>
	<hr>
	{!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => ['/users']]) !!}

	{{-- Form-group for username --}}
	<div class="form-group {{ $errors->has('username')?'has-error':'' }}">
		{!! Form::label('username',Lang::get("users.username").':',["class" => "col-xs-12 col-md-2"]) !!}
		<div class="col-xs-12 col-md-10">
			{!! Form::text('username',null,['class' => 'form-control']) !!}
			@if($errors->has('username'))
				<p class='help-block'>{{ $errors->first('username') }}</p>
			@endif
		</div>
	</div>
	{{-- Form-group for displayname --}}
	<div class="form-group {{ $errors->has('displayname')?'has-error':'' }}">
		{!! Form::label('displayname',Lang::get("users.displayname").':',["class" => "col-xs-12 col-md-2"]) !!}
		<div class="col-xs-12 col-md-10">
			{!! Form::text('displayname',null,['class' => 'form-control']) !!}
			@if($errors->has('displayname'))
				<p class='help-block'>{{ $errors->first('displayname') }}</p>
			@endif
		</div>
	</div>	
	{{-- Form-group for password --}}
	<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
		{!! Form::label('password',Lang::get("users.password").':',["class" => "col-xs-12 col-md-2"]) !!}
		<div class="col-xs-12 col-md-10">
			{!! Form::password('password',null,['class' => 'form-control']) !!}
			@if($errors->has('password'))
				<p class='help-block'>{{ $errors->first('password') }}</p>
			@endif
		</div>
	</div>

	<div class="form-group">
		{!! Form::submit(Lang::get('template.submit'),['class' => 'btn btn-primary form-control']) !!}
	</div>	
	{!! Form::close() !!}
@stop