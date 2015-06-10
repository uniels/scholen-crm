@if($person->relations()->count())


[LIST OF ALL RELATIONS]
{{ var_dump($person->relations()->toArray()) }}

@else

<p>@lang('people.norelations')</p>

@endif