@extends('layouts.admin')

@section('style')
@endsection
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ $model_text . ' ' . TITLE_CREATE }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">@lang('cms.dashboard')</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{ $model_text . ' ' . TITLE_CREATE }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <a href="{{ $button_link }}" class="btn btn-sm fw-bold btn-primary">@lang('cms.prev_text')
                    @lang('cms.page_text')</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container">
            <div class="row g-5 g-xl-12 mb-5 mb-xl-12">
                <!--begin::Col-->
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-10">
                    <div class="card">
                        <form action="{{ route('admin.' . $model . '.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="mb-10">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger alert-error">
                                                - {{ $error }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="exampleFormControlInput1" class="required form-label">@lang('cms.img')
                                        </label>
                                        <img id="img-preview" src="{{ asset($data->img) }}" width="100%"/>
                                        <small style="color:blueviolet">(800x600px ölçülerinde olmalıdır)</small>
                                        <div>
                                            <input type="file" name="img" id="img"
                                                   class="form-control mb-5 mt-5 form-control-file" accept="image/*"
                                                   onchange="readURL(this)"/>
                                        </div>


                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">@lang('cms.is_active')</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                                    data-placeholder="@lang('cms.is_active')" data-allow-clear="true" name="is_active" id="is_active"
                                                    data-hide-search="true">
                                                <option @selected(old('is_active',$data->is_active) == "1") value="1">Aktif</option>
                                                <option @selected(old('is_active',$data->is_active) == "0") value="0">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">

                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1"
                                                   class="required form-label">@lang('cms.title')</label>
                                            <input type="text" class="form-control" required name="title"
                                                   value="{{ old('title', $data->title) }}" id="title" maxlength="60"/>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="card-footer" style="padding:1rem 2.25rem !important;">
                                <button class="btn btn-warning text-dark">@lang('cms.' . $model) {{ TITLE_UPDATE }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/n7iyc0ixg4f7qw7bja3kr41pcj3n42zqut1mjpbnez8v2x9m/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            tinymce.init({
                selector: '.description',
                image_class_list: [{
                    title: 'img-responsive',
                    value: 'img-responsive'
                },],
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                },
                language: "tr_TR",
                language_url: "{{ asset('cms/assets/js/tr_TR.js') }}",
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                relative_urls: false,
                remove_script_host: true,
                convert_urls: true,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: route('admin.page.upload'),
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                    };
                    input.click();
                }
            });

            $('#title').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });
            $('#seo_title').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });

            $('#seo_description').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });

        });

        let noimage =
            "{{ asset('noimage.jpg') }}";

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", noimage);
            }
        }
    </script>
@endsection
