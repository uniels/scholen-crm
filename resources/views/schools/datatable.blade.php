<table id="tableschools" class="table table-striped display table-hover">
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
		</tr>
	</thead>
</table>
<script type="text/javascript">
jQuery(document).ready(function() {
    oTable = $('#tableschools').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
        	"url": "/data/schools",
        	"data": {
        		brinlimit: "{{ $school->brin }}",
        	}
        },
        "columns": [
            {data: 'brin_es', name: 'brin_es'},
            {data: 'name', name: 'name'},
            {data: 'place', name: 'place'},
            {data: 'provence', name: 'provence'},
            {data: 'www', name: 'www'},
        ],
        language: {
        		'url': '/js/datatable-i18/{{ App::getLocale() }}.json'
		},
        bAutoWidth:false
    });
});
</script>
