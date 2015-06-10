{!! Form::model($person,['class' => 'form-horizontal', 'method' => 'PATCH', 'action' => ['PeopleController@update',$person->id]]) !!}

@include('people.contentformbasic')
<hr>
@include('people.contentformadditional')

{!! Form::submit(Lang::get('template.submit'),['class' => 'btn btn-primary form-control']) !!}
{!! Form::close() !!}