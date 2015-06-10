<script type="text/javascript">
	$(document).ready(function(){
		//Move Modal out of the form (preventing form.submit after enter)
		$('#addcontactdetail').appendTo('body');
	});

	function makeDetail(type,label,desc,value)
	{
		var types = {
			tel: 	"tel",
			mail: "mail", 
		};


		//Create required vars
		var setlabel = desc+" ("+label+")";
		var setname = "contactdetails[new]["+type+"]["+label+"][]"; //last brackets to prevent removing double entries, eg: [tel][prive] = 06{gsm} && [tel][prive] = 010{phone}

		//Create objects
		var $newlabel 	= $('<label/>',{
								for: setname,
								class: 'col-xs-12 col-md-2', 
							}).text(setlabel+":");
		var $newfield 	= $('<div/>',{
								class: 'col-xs-12 col-md-10'
							}).append($('<div/>',{
								class: 'input-group'
							}).append($('<input/>',{
								name: setname,
								id: setname,
								type: types[type],
								value: value,
								class: 'form-control'
							})).append($('<span/>',{
								class: 'input-group-btn'
							}).append($('<button/>',{
								class: 'btn btn-danger',
								type: 'button',
								onclick: 'removeContactdetail(this)'
							}).append($('<span/>',{
								class: 'glyphicon glyphicon-remove-circle'
							}))
							)));
		var $newinfo 	= $('<div/>',{
								class: 'form-group'
							}).append($newlabel).append($newfield).appendTo('#contactdetails');		
	}

	function removeContactdetail($this)
	{
		$('.removeThisContactdetail').removeClass('removeThisContactdetail');
		$($this.closest('.form-group')).addClass('removeThisContactdetail');
		$detail = $this.closest('.form-group');
		//$detail.removeClass('form-group');
		$('#confirmRemoveContactdetail').modal('show');
	}

	function confirmedRemoveContactdetail()
	{
		$('#confirmRemoveContactdetail').modal('hide');
		var $toDelete = $('.removeThisContactdetail');
		var detail = getMeta($toDelete);
		//If the field is an old one, we need to add a delete field...
		if( !isNew(detail)){
			createDeleteField(detail);
		}
		$('.removeThisContactdetail').remove();
	}

	function getMeta($toDelete)
	{
		var $input = $toDelete.find('input');
		var name = $input.attr('name');
		return name.substr(name.indexOf("["));

	}

	function isNew(meta)
	{
		firstpart = meta.substring(name.indexOf("["),name.indexOf("]"));
		if(firstpart.match('[new]')) return true;
		return false;
	}

	function grabIDpart(meta)
	{
		var begin = meta.lastIndexOf("[")+1;
		var end = (meta.length)-1;

		return meta.substring(
			begin,end
		);
	}

	function createDeleteField(meta)
	{
		var $field = $('<input />',{
			type: 'hidden',
			name: 'contactdetails[del][]',
			value: grabIDpart(meta)
		});
		$field.appendTo('#contactdetails');
	}



</script>