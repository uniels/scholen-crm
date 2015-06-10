@extends('form.containercreate',['formid' => 'formcreateperson', 'action' => 'PeopleController@store'])

@section('formcontent')
	@include('people.contentformbasic')
	<hr>
	@include('people.contentformadditional')
@stop