@if( isset($contactdetails) && $contactdetails->count() )
	@foreach($contactdetails as $detail)
		<div class="row">
			<label class="col-md-4 col-xs-6">
				@lang('contactdetails.'.$detail->type)
				({{ $detail->pivot->label }})
			</label>
			@if( $detail->type == 'mail' )
				<a href='mailto:{{$detail->value}}' target="_blanc">{{ $detail->value }}</a>
			@else
			{{ $detail->value }} 
			@endif
		</div>	

	@endforeach
@else
	@lang('contactdetails.empty')
@endif
