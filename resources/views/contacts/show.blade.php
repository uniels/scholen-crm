@extends('template.private')

@section('component')
	<h1>				
		@lang('contacts.title')
		<small>
{{-- 			<a href="{{ route('people.show',$contact->person_id) }}">
				{{ $contact->display }}
			</a> --}}
			{!! $contact->person->link($contact->display) !!}
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
					{!! $contact->relation->link() !!}
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
		  		{!! $contact->linkedit() !!}
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
					{!! $contact->person->link(trans('people.show-me')) !!}
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