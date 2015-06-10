<div class="form-group">
{!! Form::label('contact_id',Lang::get('people.foreign').'*:',["class" => "col-xs-12 col-md-2"])  !!}
  <div class="col-xs-12 col-md-10">
    {!! Form::select('contact_id', [], null, ['class'=>'form-control', 'id' => 'contact_id']) !!}
  </div>
</div>

<script>
$('#contact_id').select2({
  ajax: {
    url: "{{ action('ContactsController@getNames') }}",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        searchquery: params.term, // search term
      };
    },
    processResults: function (data, page) {
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
