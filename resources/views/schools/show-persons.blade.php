<section class="col-md-6">
	<h3>@lang('contacts.currentcontacts')</h3>
	@if($school->contacts->count())
	<ul>
		@foreach($school->contacts as $contact )
		<li>
		<a href="{{ route('contacts.show',$contact->id) }}">
		{{ $contact->display }}
		</a>
		<a href="{{ route('people.show',$contact->person->id) }}">
		[@lang('people.show-me')]
		</a>
		</li>
		@endforeach
	</ul>
	@else
	@lang('contacts.nocontacts')
	@endif	
</section>
<section class="col-md-6">
	<h3>@lang('contacts.addcontact')</h3>
	@include('schools.addcontact')
</section>