<div class="form-group{{ $errors->has($fieldname)?' has-error':'' }}{{empty($required)?'':' bg-info'}}">
	{!! Form::label($fieldname,Lang::get($model.".".$fieldname).(empty($required)?'':'*').':',["class" => "col-xs-12"])  !!}
	@if($errors->has($fieldname))
		<p class='help-block'>{{ $errors->first($fieldname) }}</p>
	@endif
	<div class="col-xs-12">
		{!! Form::textarea($fieldname,null,['class' => 'form-control col-xs-12']) !!}
	</div>
</div>
