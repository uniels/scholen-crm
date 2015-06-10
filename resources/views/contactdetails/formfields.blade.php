<div id="contactdetails">
@if(isset($contactdetails))
 	@foreach($contactdetails as $detail)
	@if( !($detail->id = 1) ) 
		{{-- Detail->id = 1 >> Personal: we are not allowed to change this! --}}
		<div class="form-group">
			<label for="contactdetails[old][{{$detail->id}}]" class="col-md-2 col-xs-12">
				@lang('contactdetails.'.$detail->type)
				({{ $detail->pivot->label }}):
			</label>
			<div class="col-xs-12 col-md-10">
			<div class="input-group">
				{{-- 
				STRANGE BUG OVER HERE?
				when enabled, it produce an error when we submit the form with  validation-errors (other errors than this one...)
				 --}}
	{{-- 						{!! Form::input($type, "contactdetails[$type][$name][]", $value, ['class' => 'form-control']); !!} --}}
				{{-- Temporarly solution: --}}
				<input class="form-control" name="contactdetails[old][{{$detail->id}}]" type="{{$detail->type}}" value="{{$detail->value}}">
				{{-- End of this solution... --}}
				<span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="removeContactdetail(this)"><span class="glyphicon glyphicon-remove-circle"></span></button></span>
			</div></div>
		</div>			
	@endif
	@endforeach 
@endif


</div>

<btn class="btn btn-primary" data-toggle="modal" data-target="#addcontactdetail">@lang('contactdetails.adddetail')</btn>


@include('contactdetails.formmodal')

@include('contactdetails.js')