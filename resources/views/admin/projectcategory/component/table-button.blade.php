@if (Auth::user()->hasPermissionTo($model . '-edit'))
<a href="{{ route('admin.'.$model.'.edit', ['id' => $data->id]) }}" title="Bilgileri Güncelleme"
    class="btn btn-icon btn-sm btn-warning hover-scale"><i style="color:black !important;"
        class="bi bi-pen fs-4"></i></a>
@endif
@if (Auth::user()->hasPermissionTo($model . '-destroy'))
<button type="button" name="delete" id="{{ $data->id }}" title="Satırı Siler"
    class="btn btn-icon deleteButton btn-sm btn-danger hover-scale"><i class="bi bi-trash3-fill fs-4"></i></button>
@endif
