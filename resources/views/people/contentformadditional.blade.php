<h3>@lang('people.h-details')</h3>
@if(isset($person))
	@include('contactdetails.formfields',['contactdetails' => $person->contactdetails?:null])

@else
	@include('contactdetails.formfields',['contactdetails' => null])

@endif
<hr>

<h3>@lang('people.h-remarks')</h3>

@include('form.textarea',[
	'model' => 'people',
	'fieldname' => 'remarks',
	])



