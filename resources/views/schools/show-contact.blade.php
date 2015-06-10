<div class='row'><label class="col-sm-2">@lang( 'schools.tel' ):</label> {{ $school->tel }}</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.mail' ):</label> {{ $school->mail?:"-mail-" }}  </div>
<hr>
<div class='row'><label class="col-sm-2">@lang( 'schools.address' ):</label> {{ $school->cor_street }} {{ $school->cor_number }}</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.pc' ):</label> {{ $school->cor_pc }}</div>
<div class='row'><label class="col-sm-2">@lang( 'schools.place' ):</label> {{ $school->place }} ( {{ $school->municipal }})</label></div>