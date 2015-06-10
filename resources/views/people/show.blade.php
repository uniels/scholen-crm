@extends('template.private')


@section('component')
	<h1> 		
		<a href="{{ route('people.index') }}">
			@lang('people.title')
		</a> 
		<small>{{ $person->display }}</small>
	 </h1>
	<hr>
	<div role="tabpanel">

	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#person" aria-controls="person" role="tab" data-toggle="tab">@lang('people.h-person')</a></li>
	    <li role="presentation">
	    	<a href="#schools" aria-controls="schools" role="tab" data-toggle="tab">@lang('schools.title') <span class="badge">{{ $person->schoolrelations()->count() }}</span>
	    	</a>
	    </li>	    
	    <li role="presentation">
	    	<a href="#relations" aria-controls="relations" role="tab" data-toggle="tab">@lang('people.allrelations')</a>
	    </li>
	    <li role="presentation">
	    	<a href="#contactlogshow" aria-controls="contactlogshow" role="tab" data-toggle="tab">@lang('contactlog.title')</a>
	    </li>	    
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="person">
	    	@include('people.show-person')
	    </div>
	    <div role="tabpanel" class="tab-pane" id="schools">
	    	@include('people.show-schools')
	 	</div>
	    <div role="tabpanel" class="tab-pane" id="relations">
	    	@include('people.show-relations')
	 	</div>
	 	<div role="tabpanel" class="tab-pane" id="contactlogshow">
	 		<h2>@lang('contactlog.title')</h2>
	 		@include('contactlog.datatable',[
			'model' => 'person',
			'id'	=> $person->id
			])
	 	</div>

	</div>


@stop