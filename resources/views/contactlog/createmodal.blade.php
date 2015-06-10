<div class="modal fade" id="contactlogcreatemodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title">@lang('contactlog.addnewentry')</h2>
      </div>
      <div class="modal-body">
        <div class="col">
          @include('contactlog.formcreate')
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('template.cancel')</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if(isset($errors) && ($errors->has('contactdate') or $errors->has('contact_id') or $errors->has('contactdetail_id') or $errors->has('outbound') or $errors->has('summary') or $errors->has('agreements') ) )
{{-- Our modalform has some errors... --}}
<script>
$(document).ready(function(){
  $('#contactlogcreatemodal').modal('show');
});
</script>
@endif