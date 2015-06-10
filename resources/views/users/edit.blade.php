@extends('template.private')


@section('component')
	<h1> 		
		<a href="{{ route('users.index') }}">
			@lang('users.title')
		</a>
		<small>@lang('template.edit') </small>
	</h1>
	<hr>
	<div {{ $user->deleted_at? 'class=bg-danger':""}} > <!--Helper div -->
		{!! Form::model($user,['class' => 'form-horizontal', 'method' => 'PATCH', 'action' => ['UsersController@update',$user->id]]) !!}
		{{-- Static information --}}
		<div class="form-group">
			<p><label class="col-md-4 col-xs-6">#:</label> {{ $user->id }}</p>
			<p><label class="col-md-4 col-xs-6"> @lang('users.username'):</label> {{ $user->username }}
			<p><label class="col-md-4 col-xs-6"> @lang('template.created') </label> {{ date('d F Y - G:i', strtotime($user->created_at)) }}</p>
			<p><label class="col-md-4 col-xs-6"> @lang('template.updated') </label> {{ date('d F Y - G:i', strtotime($user->updated_at)) }}</p>		
		</div>
		{{-- Form-group for displayname --}}
		<div class="form-group {{ $errors->has('displayname')?'has-error':'' }}">
			{!! Form::label('displayname',Lang::get("users.displayname").':',["class" => "col-xs-12 col-md-4"]) !!}
			<div class="col-xs-12 col-md-8">
				{!! Form::text('displayname',null,['class' => 'form-control']) !!}
				@if($errors->has('displayname'))
					<p class='help-block'>{{ $errors->first('displayname') }}</p>
				@endif
			</div>
		</div>

		{{-- Password-field --}}
		<div class="form-group">
			{!! Form::label('password',Lang::get("users.passwordchange").':',["class" => "col-md-4 col-xs-6"]) !!}
			<div class="col-md-8 col-xs-6">
				{!! Form::password('password',null,['class' => 'form-control']) !!}
				<span>
					@lang('users.changepinfo')
				</span>
				@if($errors->has('password'))
					<p class='help-block'>{{ $errors->first('password') }}</p>
				@endif				
			</div>
		
		</div>
		{{-- Submit --}}
		<div class="form-group">
			{!! Form::submit(Lang::get('template.change'),['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div><!-- End helper-div -->
	{!! Form::close() !!}
	@include('errors.list')
@stop