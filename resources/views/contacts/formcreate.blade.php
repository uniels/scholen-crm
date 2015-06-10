{{-- Accepts $formurl && $select2url --}}
{!! Form::open(['class' => 'form-horizontal', 'method' => 'POST', 'url' => isset($formurl)?$formurl:'/']) !!}

	{{-- person_id-field --}}
	@include('form.selectbox',[
		'model' => 'people',
		'fieldname' => 'person_id',
		'list'	=> [],
		'required'	=> true,
		'collabel'	=> 12,
		'colfield'	=> 12,
	])
	<div id='form-group'><a href="{{ route('people.create') }}" target='_blanc'>@lang('people.makenew')</a></div>
	@include('form.textfield',[
		'model' => 'contacts',
		'fieldname' => 'function',
		'required'	=> true,
		'collabel'	=> 12,
		'colfield'	=> 12,
	])
	@include('form.inforequired')

{!! Form::submit(Lang::get('template.submit'),['class' => 'btn btn-primary form-control']) !!}
{!! Form::close() !!}

<script>
$('#person_id').select2({
  ajax: {
    url: "{{ isset($select2url)?$select2url:'/' }}",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        searchquery: params.term, // search term
      };
    },
    processResults: function (data, page) {
    	console.log(data);
      return {
        results: data
      };
    },
    cache: true
  },
  debug: true,
  width: "100%",
  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  language: 'nl',
  minimumInputLength: 2,
  placeholder: "@lang('people.searchme')",
});


</script>
<script src="/js/i18n/nl.js"></script>