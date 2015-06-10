@extends('template.public')

@section('component')
	<div class="row">
		<div class="col-sx-12 text-center">
			<h1>@lang('public.loginheader')</h1>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sx-12 col-sm-6 col-sm-offset-3">
			{!! Form::open() !!}
				<div class='form-group'>
					<!-- Username -->
					{!! Form::label('username',Lang::get('public.usernamelabel')) !!}
					{!! Form::text('username',null,['class'=>'form-control']) !!}
				</div>
				<div class='form-group'>
					<!-- Password -->
					{!! Form::label('password','Wachtwoord:') !!}
					{!! Form::password('password',['class'=>'form-control']) !!}
				</div>
				<div class='form-group'>					
					<!-- Submit form -->
					{!! Form::submit('Sesam open u!',['class' => 'btn btn-primary form-control']) !!}
				</div>
			{!! Form::close() !!}
			@include('errors.list')
		</div>
	</div>
@stop