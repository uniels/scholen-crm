@extends('template.private')

@section('component')
	<h1> 
		@lang('contactlog.title')
		<small id="relationlink">{!! $relation->link() !!}</small>
	</h1>
	<hr>
	<div class="row">
		@include('contactlog.show-list',['contactlog' => $contactlog])
	</div>
	<div class="row">
		<h2>@lang('contactlog.addnewentry')</h2>
{{-- 		<div class="row">
			<btn class="btn btn-primary" id="addcontact" onclick="addContact()">@lang("contacts.addcontact")</btn>
			<btn class="btn btn-primary" id="adddetail" onclick="addDetail()">@lang("contactdetails.adddetail")</btn>
		</div>
		<hr> --}}

		@include('contactlog.formcreate')
	</div>
	@include('contacts.modalcreate')

@stop

@section('javascript')
@parent

@stop