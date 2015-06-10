<div class='row'><label class="col-sm-2">@lang( 'schools.name' ):</label> {{ $school->name }}</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.place' ):</label> {{ $school->place }}</div>
<div class='row'>
	<label class="col-sm-2">@lang( 'schools.brin' ):</label> 
	<a href="{{ route('schoollist',['brin' => $school->brin ])  }}"> {{ $school->brin }}</a>
</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.brin_es' ):</label> {{ $school->brin_es }}</div>
<div class='row'>
	<label class="col-sm-2">@lang( 'schools.parent_brin' ):</label>			
	@if( $school->parent )
 		<a href="{{ route('schools.show',$school->parent->brin_es) }}" >{{ $school->parent->name }}</a>
 	@else
 	@lang( 'schools.no_parent')
 	@endif
 </div>
<div class='row'><label class="col-sm-2">@lang('schools.denom'):</label> {{ $school->denomination }}</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.www' ):</label> {!! $school->www !!}</div>