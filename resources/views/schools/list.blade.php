@extends('template.private')


@section('component')
	<h1> <a href="{{ route('schools.index') }}">
			@lang('schools.title')
		</a>
		<small><a href="{{ route('schools.show', $school->brin_es) }}">{{ $school->brin }}</a></small>
	</h1>
	<hr>
	@include('schools.datatable')
	
@stop

@section('javascript')
    <!-- Added functionality for the dataTables... -->
    <script src="/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#tableschools').DataTable();
		} );	
	</script>
@stop