@extends('template.private')

@section('component')
	<h1>				
		@lang('contacts.title')
		<small>
			<a href="{{ route('people.show',$contact->person_id) }}">
				{{ $contact->display }}
			</a>
		</small>
	</h1>
	<hr>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">@lang('contacts.info')</h3>
		</div>
		<div class="panel-body">
		  	<div>
				<div class="row">
					<label class="col-md-4 col-xs-6">
						@lang('contacts.name')
					</label>
					<a href='{{ $contact->relation->showpage }}'>
						{{ $contact->relation->display }}
					</a>
				</div>
				<div class="row">
					<label class="col-md-4 col-xs-6">
						@lang('contacts.type')
					</label>
					{{ $contact->type }}
				</div>				
				<div class="row">
					<label class="col-md-4 col-xs-6">
						@lang('contacts.function')
					</label>
					{{ $contact->function }}
				</div>								  		
		  	</div>
		  	<hr>		  
		  	<div class="col">
		  		@include('contactdetails.display',["contactdetails" => $contact->contactdetails])
		  	</div>
		  	<div class="col">
		  		<a href='{{ action('ContactsController@edit',$contact->id) }}'>
		  			{{ $contact->display }}
		  		</a>
		  	</div>
		  	<div class="col">
		  		
		  	</div>		  		
		</div>
	</div>
	<div class="panel panel-default">
		  <div class="panel-heading">
				<h3 class="panel-title">@lang('people.h-details')</h3>
		  </div>
		  <div class="panel-body">
				<div class="col">
					@include('contactdetails.display',["contactdetails" => $contact->person->contactdetails])
				</div>
				<div class="col">
					<a href='{{ action('PeopleController@show',$contact->person->id) }}'>
						@lang('people.show-me')
					</a>
				</div>
		  </div>
	</div>
	<div class="panel panel-default">
		  <div class="panel-heading">
				<h3 class="panel-title">@lang('contactlog.title')</h3>
		  </div>
		  <div class="panel-body">
			@include('contactlog.datatable',[
			'model' => 'contact',
			'id'	=> $contact->id
			])
		  </div>
	</div>
@stop

@section('javascript')

@stop