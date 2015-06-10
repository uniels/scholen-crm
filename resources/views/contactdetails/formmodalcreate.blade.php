{{-- YOU HAVE TO IMPLEMENT THE function makeDetail(type,label,desc,value) --}}
<div id="addcontactdetail" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="$('#addcontactdetail').modal('hide')"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">@lang('contactdetails.detail')</h3>
      </div>
      <div class="modal-body">
      	<div class="row">
	      	{{-- Form-group for typelabel-field --}}
	      	<div class="col col-xs-12">
	      		{!! Form::label('typelabel',Lang::get('contactdetails.labeltype').':') !!}
	      		{!! Form::select('labeltype',[
	      				'tel' => Lang::get('contactdetails.tel'),
	      				'mail' => Lang::get('contactdetails.mail')
	      		],null,[
	      			'id' => 'contactdetailtype', 
	      			'class' => 'form-control'
	      			]) !!}
	      	</div>

	      	{{-- Form-group for addlabel-field --}}
	      	  <div class="col col-xs-12">
	      	  	{!! Form::label('addlabel',Lang::get('contactdetails.labeltext').':') !!}
	      	  	{!! Form::text('addlabel',null,["id" => "contactdetaillabel", 'class' => 'form-control']) !!}
	      	  </div> 
	      	{{-- Form-group for value-field --}}
	      	  <div class="col col-xs-12">
	      	  	{!! Form::label('value',Lang::get('contactdetails.value').':') !!}
	      	  	{!! Form::text('value',null,["id" => "contactdetailvalue", 'class' => 'form-control']) !!}
	      	  </div>  	      	   
      	</div>
      </div>
      <div class="modal-footer">
	      <div class="row">
	      	<div class="col col-xs-12">
	        <button type="button" class="btn btn-default" onclick="$('#addcontactdetail').modal('hide')">@lang('template.cancel')</button>
	        <button type="button" class="btn btn-primary" onclick="addContactdetail()">@lang('template.add')</button>
	      </div>
	    </div>
      </div>
    </div>{{-- /.modal-content --}}
  </div>{{-- /.modal-dialog --}}
  <script>
	function addContactdetail()
	{

		//Fetch needed vars
		var type =  $('#contactdetailtype').val();
		var label = $('#contactdetaillabel').val();
		var desc = $('#contactdetailtype option:selected').text();
		var value = $('#contactdetailvalue').val();

		//Do we have a label?
		if(!label){
			$('#contactdetaillabel').tooltip({
				placement: 'bottom',
				title: "@lang('contactdetails.addlabel')", 
			});
			$('#contactdetaillabel').tooltip('show');
			console.log('showme');
			return null;
		}

		makeDetail(type,label,desc,value);
		
		closeModal();
	}

	function closeModal()
	{
		$('#contactdetaillabel').val(null);//make empty, for next entry.
		$('#contactdetailvalue').val(null);//make empty, for next entry.
		$('#addcontactdetail').modal('hide');
	}
  </script>
</div>{{-- /.modal --}}
