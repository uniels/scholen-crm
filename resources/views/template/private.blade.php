@extends('template.basic')

@section('mainbar')
<nav class="navbar navbar-default navbar-fixed-top">
 	<div class="container-fluid">
	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#webapp-content">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/start"><span class="glyphicon glyphicon-home"></span> S-CRM</a>
		</div>
		<div class="collapse navbar-collapse" id="webapp-content">

	      	<ul class="nav navbar-nav">
{{-- 	        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> --}}
				{{-- User-group menu --}}
	        	<li class="dropdown">
	          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> @lang('users.title') <span class="caret"></span></a>
	          		<ul class="dropdown-menu" role="menu">
	            		<li><a href="{{ route('users.index') }}"> @lang('template.index') </a></li>
	           			<li><a href="{{ route('users.create') }}"> @lang('template.create') </a></li>
	          		</ul>
	       		</li>
	       		{{-- School-group menu --}}
	        	<li class="dropdown">
	          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> @lang('schools.title') <span class="caret"></span></a>
	          		<ul class="dropdown-menu" role="menu">
	            		<li><a href="{{ route('schools.index') }}"> @lang('template.index') </a></li>
	            		<li class="divider"></li>
	            		<li><a href="{{ route('schools.create') }}"> @lang('template.import') </a></li>
	          		</ul>
	      		</li>
	       		{{-- Person-group menu --}}
	        	<li class="dropdown">
	          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> @lang('people.title') <span class="caret"></span></a>
	          		<ul class="dropdown-menu" role="menu">
	            		<li><a href="{{ route('people.index') }}"> @lang('template.index') </a></li>
	            		<li><a href="{{ route('people.create') }}"> @lang('template.create') </a></li>
	          		</ul>
	      		</li>
	      </ul>

	      <!-- Logout -->
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="{{ url('logout') }}"><span class="glyphicon glyphicon-log-out"></span> @lang('template.logout')</a></li>
	      </ul>

	    </div><!-- div.navbar-collapse --> 
 	</div><!-- div.container-fluid -->
</nav>
@stop

@section('content')
	@include('errors.list')
	<article>
		@yield('component')
	</article>
@stop