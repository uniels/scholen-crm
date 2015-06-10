@extends('template.private')

@section('component')
	<h1> 
		<a href="{{ route('contactlog.index') }}">
			@lang('contactlog.title')
		</a>
		<small>@lang('template.edit')</small>
	</h1>
	<hr>
	

	{!! Form::model($contactlog,['class' => 'form-horizontal', 'method' => 'PATCH', 'action' => ['ContactLogController@update',$contactlog]]) !!}
		@include('contactlog.show-basic')
		<hr>
		<div class="row">
			@include('form.textfield',[
				'model'		=> 'contactlog',
				'fieldname' => 'summary',
				'required'	=> true,
			])
		</div>
		<div class="row">
			@include('form.textarea',[
				'model'		=> 'contactlog',
				'fieldname' => 'agreements',
				'required'	=> false,
			])
		</div>
		<div class="row">
			@include('form.inforequired')
		</div>
		<div class="row">
			{!! Form::submit(Lang::get('template.edit'),['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}

@stop
@stop
