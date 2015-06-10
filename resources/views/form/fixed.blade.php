{{-- Accepts: fieldname, model, collabel, colfield, value --}}

<div class="form-group">
{!! Form::label($fieldname,Lang::get($model.".".$fieldname).':',["class" => "col-xs-12 col-md-".(empty($collabel)?"2":$collabel)]) !!}
	<div class="col-xs-12 col-md-{{ empty($colfield)?((empty($collabel) or ($collabel > 6))?10:12-$collabel):$colfield }}">
		{!! $value !!}
	</div>
</div>