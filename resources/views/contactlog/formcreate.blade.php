@extends('form.containercreate',['formid' => 'createcontactlog', 'action' => 'ContactLogController@store'])

@section('formcontent')
	{{-- Date of contact --}}
	@include('form.datetimefield',[
		'model' => 'contactlog',
		'fieldname' => 'contactdate',
		'required'	=> true
		])
	{{-- Select contact id --}}
	@if( isset($contact) && !empty($contact->toArray()) )
		{{-- Contact pre-selected --}}
		{!! Form::hidden('contact_id',$contact->id) !!}
		@include('form.fixed',[
			'fieldname' => 'contact_id',
			'model' => 'contacts',
			'value' => '<p id="contacthiddenname">{{ $contact->display }}</p>'
		])
	@elseif(isset($contacts) && !empty($contacts->toArray()))
		{{-- There is a list of contacts --}}
		@include('form.selectbox',[
			'fieldname'	=> 'contact_id',
			'model'		=> 'contacts',
			'required'	=> true,
			'list'		=> $contacts->lists('display', 'id')
		])
	@else
		{{-- No contact available --}}
		@include('form.fixedrequired',[
			'fieldname' => 'contact_id',
			'model' => 'contacts',
			'required'=> true,
			'value' => '<div id="contactdetailsplaceholder">['.trans("contacts.addcontact").']</div>'
		])
		
	@endif

	{{-- Select contactdetails --}}
	@include('form.selectbox',[
		'fieldname'	=> 'contactdetail_id',
		'model'		=> 'contactdetails',
		'required'	=> true,
		'list'		=> []
	])
	<div id="addcontactdetailsbuttongroup" class="form-group">
		<div class="col col-xs-12">
			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcontactdetail">
			  @lang('contactdetails.addnewdetail')
			</button>
		</div>
		<script>
			function makeDetail(type,label,desc,value){
				var $destination = $('#contactdetail_id').parent();
				$('#contactdetail_id').remove();
				var $formfield = $('<input/>',{
								name: 'contactdetails['+type+"]["+label+"][]",
								type: 'hidden',
								value: value,
							});

				var $output = $('<p />').html("<strong>"+desc+" ("+label+"):</strong> "+value);
				$output.append($formfield);
				$('#addcontactdetailsbuttongroup').remove();
				$destination.append($output);

			}
		</script>
	</div>

	{{-- Outbound of inbound? --}}
	<div class="form-group{{ $errors->has('outbound')?' has-error':'' }} bg-info">
		{!! Form::label('outbound',Lang::get('contactlog.outbound').'*:',["class" => "col-xs-12 col-md-12"]) !!}
		<div class="col-xs-12 col-md-12">

			<div class='col col-xs-5'>
				{{ Auth::user()->displayname }}
			</div>
			<div class='col col-xs-2'>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-sm btn-primary @if(Form::old('outbound') === '0') {{'active'}} @endif">
						<input type="radio" name="outbound" value="0" @if(Form::old('outbound') === '0') {{'checked'}} @endif>
						<span class='glyphicon glyphicon-chevron-left'></span>
					</label>
					<label class="btn btn-sm btn-primary{{ Form::old('outbound')?' active':'' }}">
						<input type="radio" name="outbound" value="1" {{ Form::old('outbound')?'checked':'' }}>
						<span class='glyphicon glyphicon-chevron-right'></span>
					</label>				
				</div>
			</div>
			<div  class='col col-xs-5'>
				<span id="currentcontactname"> </span>
			</div>

			@if($errors->has('outbound'))
				<div class='col col-xs-12 help-block'>{{ $errors->first('outbound') }}</div>
			@endif
		</div>
	</div>

	<hr>
	
	@include('form.textfield',[
		'model' => 'contactlog',
		'fieldname' => 'summary',
		'required'	=> true
		])
	@include('form.textarea',[
		'model' => 'contactlog',
		'fieldname' => 'agreements',
		])
	@include('form.inforequired')

@stop

@section('formaddition_createcontactlog')
	@include('contactdetails.formmodalcreate')
@stop

@section('javascript')
	@parent
	@include('contactlog.formjs')
@stop