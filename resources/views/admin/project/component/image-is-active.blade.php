<div class="form-check form-switch form-check-custom form-check-solid">
    <input class="form-check-input h-20px w-45px is_active" @if ($data->is_active == 1) checked="checked" @endif
        type="checkbox" data-id="{{ $data->id }}" data-url="{{ route('admin.projectgallery.is_active') }}" id="githubswitch" />
    <label class="form-check-label" for="githubswitch"></label>
</div>
