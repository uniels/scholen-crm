<div class="row">
	@include('form.fixed',[
		'model'		=> 'contactlog',
		'fieldname' => 'contactdate',
		'value' 	=> $contactlog->contactdate,
		'required'	=> false,
	])
</div>
	{{-- Outbound of inbound? --}}
<div class="row">
	<div class="form-group{{ $errors->has('outbound')?' has-error':'' }}">
		{!! Form::label('outbound',Lang::get('contactlog.outbound').':',["class" => "col-xs-12 col-md-2"]) !!}
		<div class="col-xs-12 col-md-10">
			<div class="row">
				<div class='col col-xs-5'>
					{!! $contactlog->user->link() !!}
				</div>
				<div class='col col-xs-2'>
					<span class='glyphicon glyphicon-chevron-{{$contactlog->outbound?"right":"left"}}'></span>
				</div>
				<div  class='col col-xs-5'>
					{!! $contactlog->contact->link() !!}
				</div>
			</div>
		</div>
	</div>
</div>