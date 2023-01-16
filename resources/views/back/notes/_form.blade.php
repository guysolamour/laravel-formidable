{!! form_start($form) !!}

{!! form_rest($form) !!}


<x-administrable::tinymce
    selector="textarea[data-tinymce]"
    :model="$form->getModel()"
/>


@if (isset($edit) && $edit)
<div class="form-group">
    <button type="submit" class="btn btn-success"> <i class="fa fa-edit"></i> Modifier</button>
</div>
@endif

@if (!isset($edit))
<div class="form-group">
    <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Enregistrer</button>
</div>
@endif


{!! form_end($form) !!}

{{-- add daterange here --}}
