	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">@lang('people.h-person')</h3>
		</div>
		<div class="panel-body">
			<div class='row'><label class="col-md-4 col-xs-6">#:</label> {{ $person->id }}</div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('template.created') </label> {{ date('d F Y - G:i', strtotime($person->created_at)) }}</label></div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('template.updated') </label> {{ date('d F Y - G:i', strtotime($person->updated_at)) }}</label></div>	
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.firstname'):</label>{{ $person->firstname }}</div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.initials'):</label>{{ $person->initials }}</div>		
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.prefix'):</label>{{ $person->prefix }}</div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.lastname'):</label>{{ $person->lastname }}</div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.nickname'):</label>{{ $person->nickname }}</div>
			<div class='row'><label class="col-md-4 col-xs-6"> @lang('people.birthday'): </label>
			@if($person->birthday) 
				{{ date('d F Y', strtotime($person->birthday)) }}
			@else
				@lang('people.birthdayUnknown')
			@endif
			</div>
			<div class="col"><a class="btn btn-primary" aria-label="@lang('template.edit')" href="{{ route('people.edit', ['id' => $person->id]) }}">
				@lang('template.edit')
			</a></div>
		</div>
	</div>
	
	{{-- Panel for Personal Details --}}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">@lang('people.h-details')</h3>
		</div>
		<div class="panel-body">
			@include('contactdetails.display',["contactdetails" => $person->contactdetails])
		</div>
	</div>
	{{-- End panel Personal Details --}}
	{{-- Panel for remarks --}}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">@lang('people.h-remarks')</h3>
		</div>
		<div class="panel-body">
			@if( $person->remarks )
			<div class='row'><label class="col-sm-12"> @lang('people.remarks') </label></div>
			<div class="row">{{ $person->remarks }}</div>
			</div>
			@else
				@lang('people.noremarks')
			@endif
		</div>
	</div>
	{{-- End panel remarks --}}