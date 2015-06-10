@if($person->schoolrelations()->count())
<table class="table table-striped display" id="tableschools" {{-- data-toggle="table" --}}>
    <thead>
		<tr>
			<th data-field="function" data-align="left">
				@lang('people.function')
			</th>		
			<th data-field="schoolname" data-align="left">
				@lang('schools.name')
			</th>
			<th data-field="schoolplace" data-align="left">
				@lang('schools.place')
			</th>
			<th data-field="action" data-align="left">@lang('template.actions') </th>
		</tr>
	</thead>

	<tbody>
	@foreach($person->schoolrelations() as $contact)
		<tr>
 			<td data-field="function" data-align="left">
				<a href="{{ route('contacts.show',$contact->id) }}">
					{{ $contact->function }}
				</a>
			</td>
			<td data-field="schoolname" data-align="left">
				<a href="{{ route('schools.show',$contact->relation->brin_es) }}">
				{{ $contact->relation->name }}
				</a>
			</td>
			<td data-field="schoolplace" data-align="left">
				{{ $contact->relation->place }}
			</td>
			<td data-field="actions" data-align="left">
				{!! $contact->linkdestroy() !!}
			</td>									
		</tr>
	@endforeach
	</tbody>
</table>
@else
<p>@lang('people.norelations')</p>
@endif