<h3>@lang('people.h-person')</h3>

@include('form.textfield',[
	'model' => 'people',
	'fieldname' => 'firstname',
	'required'	=> true
	])
@include('form.textfield',[
	'model' => 'people',
	'fieldname' => 'initials',
	'colfield'	=> 2
	])
@include('form.textfield',[
	'model' => 'people',
	'fieldname' => 'prefix',
	'colfield'	=> 2
	])

@include('form.textfield',[
	'model' => 'people',
	'fieldname' => 'lastname',
	'required'	=> true
	])
@include('form.textfield',[
	'model' => 'people',
	'fieldname' => 'nickname',
	])
@include('form.datefield',[
	'model' => 'people',
	'fieldname' => 'birthday',
	'colfield'	=> 4
	])
@include('form.inforequired')


