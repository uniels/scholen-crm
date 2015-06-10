@extends('template.private')


@section('component')
	<h1> @lang('schools.title') </h1>
	<hr>
	@include('schools.datatable')
	
@stop

@section('javascript')

@stop
{{-- 
    <!-- Added functionality for the dataTables... -->
    <script src="/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#tableschools').DataTable();
		    console.log('ready!');
		} );	
	</script>
 --}}