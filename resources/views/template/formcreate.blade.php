{!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'action' => $action]) !!}

	@yield('formcontent')
{!! Form::submit(Lang::get('template.submit'),['class' => 'btn btn-primary form-control']) !!}
{!! Form::close() !!}