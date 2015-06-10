@extends('template.private')


@section('component')
	<h1> 
		<a href="{{ route('schools.index') }}">
			@lang('schools.title')
		</a>
		<small>@lang('template.import')</small>
	</h1>
	<hr>
		<ul id="displayForm">
			<li>@lang('schools.download')</li>
			<li>@lang('schools.importhere')</li>
			<li>
				{!! Form::open([
					'id'	=> 'schoolsform',
					'class' => 'form-inline', 
					'method' => 'POST', 
					'action' => 'SchoolsController@store', 
					'files' => 'true'
					]) !!}
				<div class="form-group">
					{!! Form::file('xls_file',['id' => 'xls_file']) !!}
					@if($errors->has('xls_file'))
						<p class='help-block'>{{ $errors->first('xls_file') }}</p>
					@endif	
				</div>
				<div class="form-group">
				<a class="btn btn-primary form-control" onclick="submitform()"> 
					@lang('template.submit')
				</a>
                </div>
				{!! Form::close() !!}
			</li>
		</ul>
		@include('errors.list')
	{{-- Modal for the 'bePatient' message, when submitting the form... --}}
	<div id="displayUpload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h3 class="modal-title"><span class="glyphicon glyphicon-hourglass"></span>@lang('template.bepatient')</h3>
	      </div>
	      <div class="modal-body">
	        @lang('schools.uploading')
			<div class="progress">
			  <div class="progress-bar progress-bar-striped active" role="progressbar"
			  aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:100%">
			  </div>
			</div>

	      </div>
	    </div>
	  </div>
	</div>
	{{-- End of Modal --}}
<script type="text/javascript">
	/**
	 * Validates if a file is selected...
	 * @return {boolean} true if a file is selected
	 */
	function validate(){
	     if( !( $('[name="xls_file"]').val() == '' ) ){
	        return true;
	     }
	    return false;
	}
	/**
	 * When a user pressed the button to upload the file.
	 * First validates if a file is selected.
	 * If so: display the BePatient modal.
	 * Else
	 * @return {[type]} [description]
	 */
	function submitform(){

		if(validate()){
			$('#displayForm').addClass('hidden');
			$('#displayUpload').modal({
				backdrop: 'static',
				keyboard: false,

			});
			$('#schoolsform').submit();				
		} else {
			$('[name="xls_file"]').popover({
				dataplacement: "right",
				content: "@lang('template.firstaddfile')",
				}).popover('show');
		}

	}



</script>
	{{-- @include('actionscripts.fileinput') --}}
@stop