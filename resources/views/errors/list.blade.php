@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p>@lang('template.correcterrors')</p>
    {{ var_dump($errors)}}
</div>
@endif