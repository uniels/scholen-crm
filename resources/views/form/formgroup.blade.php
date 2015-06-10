{{-- Accepts: fieldname, model, collabel, colfield, required --}}
<div class="form-group{{ $errors->has($fieldname)?' has-error':'' }}{{empty($required)?'':' bg-info'}}">
	{!! Form::label($fieldname,Lang::get($model.".".$fieldname).(empty($required)?'':'*').':',["class" => "col-xs-12 col-md-".(empty($collabel)?"2":$collabel)]) !!}
	<div class="col-xs-12 col-md-{{ empty($colfield)?((empty($collabel) or ($collabel > 6))?10:12-$collabel):$colfield }}">
		@yield('formfield')
		@if($errors->has($fieldname))
			<p class='help-block'>{{ $errors->first($fieldname) }}</p>
		@endif
	</div>
</div>