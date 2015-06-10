@include('contactdetails.formmodalcreate')

{{-- Modal for confirming contactdetail deletion--}}
<div id="confirmRemoveContactdetail" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">@lang('template.confirmdeletion')</h3>
      </div>
      <div class="modal-body">
      	<div>

      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('template.cancel')</button>
        <button type="button" class="btn btn-danger" onclick="confirmedRemoveContactdetail()">@lang('template.remove')</button>
      </div>
    </div>{{-- /.modal-content --}}
  </div>{{-- /.modal-dialog --}}
</div>{{-- /.modal --}}