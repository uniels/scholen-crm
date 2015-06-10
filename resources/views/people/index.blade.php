@extends('template.private')


@section('component')
	<h1> @lang('people.title') </h1>
	<hr>
	<table class="table table-striped display" id="tablepeople">
	    <thead>
			<tr>
				<th data-field="firstname" data-align="center">
					@lang('people.firstname')
				</th>
				<th data-field="prefix" data-align="center">
					@lang('people.prefix')
				</th>
				<th data-field="lastname" data-align="left">
					@lang('people.lastname')
				</th>
				<th data-field="nickname" data-align="left">
					@lang('people.nickname')
				</th>
			</tr>
		</thead>
	</table>

	
@stop

@section('javascript')
<script type="text/javascript">
jQuery(document).ready(function() {
    oTable = $('#tablepeople').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
        	"url": "/data/people"
        },
        "columns": [
            {data: 'firstname', name: 'firstname'},
            {data: 'prefix', 	name: 'prefix'},
            {data: 'lastname', 	name: 'lastname'},
            {data: 'nickname', 	name: 'nickname'},
        ],
        language: {
        		'url': '/js/datatable-i18/{{ App::getLocale() }}.json'
		},
	    bAutoWidth:false
    });
});
</script>
@stop