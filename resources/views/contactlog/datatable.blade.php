<table id="tablecontactlog" class="table table-striped display table-hover">
    <thead>
		<tr>
			<th data-field="contactdate" data-align="center">
				@lang('contactlog.contactdate')
			</th>
			<th data-field="user" data-align="center">
				@lang('users.foreign')
			</th>
			<th data-field="outbound" data-align="left">
				@lang('contactlog.outbound-short')
			</th>
			<th data-field="contact" data-align="left">
				@lang('contacts.contact_id')
			</th>
			<th data-field="summary" data-align="left">
				@lang('contactlog.summary')
			</th>
		</tr>
	</thead>
</table>
<script type="text/javascript">
jQuery(document).ready(function() {
    oTable = $('#tablecontactlog').DataTable({
        "bSort" : false,
        "bFilter": false,
        "processing": true,
        "serverSide": true,
        "ajax":{
        	"url": "/data/contactlog",
        	"data": {
                //additional fields...
                @if(isset($model) && isset($id))
                "model" : "{{$model}}",
                "id"    : "{{$id}}"
                @endif
        	}
        },
        "columns": [
            {data: 'contactdate', name: 'contactdate'},
            {data: 'user', name: 'user'},
            {data: 'outbound', name: 'outbound'},
            {data: 'contact', name: 'contact'},
            {data: 'summary', name: 'summary'},
        ],
        language: {
        		'url': '/js/datatable-i18/{{ App::getLocale() }}.json'
		},
        bAutoWidth:false
    });
});
</script>
