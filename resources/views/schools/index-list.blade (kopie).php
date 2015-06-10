@if($schools)
<table class="table table-striped display" id="tableschools" {{-- data-toggle="table" --}}>
    <thead>
		<tr>
			<th data-field="brin_es" data-align="center">
				@lang('schools.brin')
			</th>
			<th data-field="name" data-align="center">
				@lang('schools.name')
			</th>
			<th data-field="place" data-align="left">
				@lang('schools.place')
			</th>
			<th data-field="provence" data-align="left">
				@lang('schools.provence')
			</th>
			<th data-field="www" data-align="left">
				@lang('schools.www')
			</th>
			<th data-align="left">@lang('template.actions') </th>

		</tr>
	</thead>
	<tbody>
	@foreach($schools as $school)
	<tr>
		<td data-field="brin_es" data-align="left">
			{{ $school->brin_es }}
		</td>
		<td data-field="name" data-align="left">
			<a href='{{ route('schools.show', ['id' => $school->brin_es]) }}'>{{ $school->name }}</a>
		</td>
		<td data-field="place" data-align="left">
			{{ $school->place }}
		</td>
		<td data-field="provence" data-align="left">
			{{ $school->provence }}
		</td>
		<td data-field="www" data-align="left">
			{!! $school->www !!}
		</td>
		<td>[Actieknoppen?]</td>
	</tr>
	@endforeach
	</tbody>
</table>

@else
<p>@lang('schools.noshow')</p>
@endif