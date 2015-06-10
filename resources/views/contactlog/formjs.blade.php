<script>
$(document).ready(function()
{
	$('#contact_id').change(function(){
		grabContact();
	});
	grabContact();
});

function grabContact()
{
	//Retreive values and set contactid and contactname
	var $contactselect = $('#contact_id option:selected');
	var $contacthidden = $('#contact_id');
	var contactid = 0;
	var contactname = "@lang('contactlog.unknown')";
	if ($contactselect.length > 0){
		//There is a selectbox
		contactid = $contactselect.val();
		contactname = $contactselect.text(); 	
	} else if( ($contacthidden.length > 0) & ($('#contacthiddenname').length > 0 )) {
		//There is no selectbox, there shoulde be a hidden input...
		contactid = $contacthidden.val();
		contactname = $('#contacthiddenname').text();
	}

	//Set contactdetails for select...
	openContactdetail(contactid);

	//Set contactname for inbound/outbound
	$('#currentcontactname').text(contactname);
}

function openContactdetail(contact_id)
{
	if(contact_id && contact_id > 0){
		$.ajax({
			method: 'GET',
			url: "{{ action('ContactdetailsController@getData') }}",
			data: {
				id: contact_id
			},
			dataType: 'json',
		}).done(function(data){
			createContactdetails(data);
		}).fail(function(){
			console.log('fail');
			createContactdetails(null);
		});
	} else {
		createContactdetails(null);
	}

}
function createContactdetails(data)
{
	var $selectbox = $('#contactdetail_id').html('');
	$message = $('<option />').attr('disabled','disabled').attr('selected','selected').val('').text("{{ trans('contactlog.selectdetail') }}");
	$selectbox.append($message);
	if(data){
		$.each(data,function(details){
			if( !($.isEmptyObject(details) ) ){
				$opt = $('<optgroup />',{
					label: details
				})
				$.each(data[details],function(detail){
					var info = data[details][detail];
					var option = $('<option />').val(info.id).text(info.label);
					$opt.append(option);
				});
				$selectbox.append($opt);
			}
		});			
	}
}

function addContact()
{

}
function addDetail()
{
	
}

</script>