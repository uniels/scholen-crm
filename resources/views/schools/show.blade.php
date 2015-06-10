@extends('template.private')


@section('component')
	<h1> 		
		<a href="{{ route('schools.index') }}">
			@lang('schools.title')
		</a>
		<small>@lang('template.show')</small> </h1>
	<hr>
	<div role="tabpanel">
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active">
				<a href="#common" aria-controls="common" role="tab" data-toggle="pill">
					@lang( 'schools.h-common' )
				</a>
			</li>
			<li role="presentation">
				<a href="#settling" aria-controls="settling" role="tab" data-toggle="pill">
					@lang( 'schools.h-settling' )
				</a>
			</li>
			<li role="presentation">
				<a href="#correspondence" aria-controls="correspondence" role="tab" data-toggle="pill">
					@lang( 'schools.h-cor' )
				</a>
			</li>
			@if( $school->children->count() )
			<li role="presentation">
				<a href="#children" aria-controls="children" role="tab" data-toggle="pill">
					@lang( 'schools.h-children' )
					<span class="badge">{{ $school->children->count() }}</span>
				</a>
			</li>
			@endif
			<li role="presentation">
				<a href="#contacts" aria-controls="contacts" role="tab" data-toggle="pill">
					@lang( 'schools.h-contacts' )
					<span class="badge">{{ $school->contacts->count() }}</span>
				</a>
			</li>
			<li >
				<a href="{{ action('SchoolsController@getContactlog',['school' => $school->brin_es]) }}" class='btn btn-default'>
					@lang( 'contactlog.title' )
					{{-- <span class="badge"><!-- count the logs...  --></span> --}}
				</a>
			</li>
		</ul>
		<hr>
		{{-- Tab Panes --}}
		<div class="tab-content">
			{{-- Common info --}}
			<div role="tabpanel" class="tab-pane active" id="common">
			@include('schools.show-info')
			</div>
			{{-- Settling information --}}
			<div role="tabpanel" class="tab-pane" id="settling">
			@include('schools.show-settlement')
		 	</div>
		 	{{-- Correspondence information --}}
			<div role="tabpanel" class="tab-pane" id="correspondence">
			@include('schools.show-contact')
			</div>
			{{-- Underlying schools --}}
			@if( $school->children->count() )
			<div role="tabpanel" class="tab-pane" id="children">
				<div class="row">
					<ul>
					@foreach($school->children as $child )
						<li><a href="{{ route('schools.show',[$child]) }}" >{{ $child->name }}</a></li>
					@endforeach
					</ul>
				</div>
			</div>
			@endif
			{{-- Contactpersons overview --}}
			<div role="tabpanel" class="tab-pane" id="contacts">
			@include('schools.show-persons')
			</div>			
		</div>
	</div>
	</div>
	<hr>
	<div class='row'>
		@include('schools.show-map')
	</div>
@stop