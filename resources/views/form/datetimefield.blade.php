
<div class="form-group{{ $errors->has($fieldname)?' has-error':'' }}{{empty($required)?'':' bg-info'}}">
	{!! Form::label($fieldname.'-ui',Lang::get($model.".".$fieldname).(empty($required)?'':'*').':',["class" => "col-xs-12 col-md-".(empty($collabel)?"2":$collabel)]) !!}

	{{-- date('d-m-Y - H:i') --}}
	<div class="col-xs-12 col-md-{{ empty($colfield)?((empty($collabel) or ($collabel > 6))?10:12-$collabel):$colfield }}">
		<div class="input-group date form_datetime col-md-5">
			{!! Form::input('text',$fieldname.'-ui',null,[
				'class' => 'form-control',
				'readonly' => true,
				'placeholder' => isset($placeholder)?$placeholder:Lang::get($model.".".$fieldname)
			]) !!}
	        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
			<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
		</div>
		{!! Form::hidden($fieldname,null,['id' => $fieldname]) !!}
		@if($errors->has($fieldname))
			<p class='help-block'>{{ $errors->first($fieldname) }}</p>
		@endif		
	</div>			

</div>
<script type="text/javascript" src="/js/locale/datetimepicker.nl.js" charset="UTF-8"></script>



@section('javascript')
	@parent
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#{{$fieldname}}-ui').datetimepicker({
		        language:  'nl',
		        format: "dd-mm-yyyy - hh:ii",
		        weekStart: 1,
		        todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
				linkField: "{{$fieldname}}",
				linkFormat: "yyyy-mm-dd hh:ii:ss"
		    });		
		});
		//Y-m-d H:i:s
	</script>
@stop