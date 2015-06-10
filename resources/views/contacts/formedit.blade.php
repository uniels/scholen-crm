{!! Form::model($contact,['class' => 'form-horizontal', 'method' => 'PATCH', 'action' => ['ContactsController@update',$contact->id]]) !!}

	{{-- relation-name-field (fixed)  --}}
	@include('form.fixed',[
		'fieldname' => 'name',
		'model'		=> 'contacts',
		'value'		=> $contact->relation->link()
	])
	{{-- relation-type-field (fixed)  --}}
	@include('form.fixed',[
		'fieldname' => 'type',
		'model'		=> 'contacts',
		'value'		=> $contact->type
	])
	{{-- relation-type-field (fixed)  --}}
	@include('form.fixed',[
		'fieldname' => 'person',
		'model'		=> 'contacts',
		'value'		=> $contact->person->link()
	])
	{{-- Form-group for function --}}
	@include('form.textfield',[
		'fieldname'	=> 'function',
		'model'		=> 'contacts',
	])


	<hr>
	<h3>@lang('contactdetails.title')</h3>
	@include('contactdetails.formfields',['contactdetails' => $contact->contactdetails?:null])

	<hr>
{!! Form::submit(Lang::get('template.change'),['class' => 'btn btn-primary form-control']) !!}
{!! Form::close() !!}