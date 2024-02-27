@extends('layouts.admin')
@section('style')
@endsection
@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container d-flex flex-stack">
            <!--begin::Page title_small-->
            <div class="page-title_small d-flex flex-column justify-content-center flex-wrap me-3">
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
            <!--end::Page title_small-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <a href="{{ $button_link }}" class="btn btn-sm fw-bold btn-primary">@lang('cms.prev_text') @lang('cms.page_text')</a>
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

                        <form action="{{ route('admin.' . $model . '.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
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
                                        <img id="img-preview" src="{{ asset('noimage.jpg') }}" width="100%" />
                                        <small style="color:blueviolet">(1920x650 ölçülerinde olmalıdır)</small>
                                        <div>
                                            <input type="file" name="img" id="img"
                                                class="form-control mb-5 mt-5 form-control-file" accept="image/*"
                                                onchange="readURL(this)" />
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1"
                                                class="required form-label">@lang('cms.title_small')</label>
                                            <input type="text" class="form-control" required name="title_small"
                                                value="{{ old('title_small') }}" id="title_small" maxlength="60" />
                                        </div>

                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1"
                                                class="required form-label">@lang('cms.title_big')</label>
                                            <input type="text" class="form-control" required name="title_big"
                                                value="{{ old('title_big') }}" id="title_big" maxlength="60" />
                                        </div>
{{-- 
                                        <div class="mb-5">
                                            <label class=" required form-label">@lang('cms.description')</label>
                                            <textarea class="form-control" required name="description" id="description" maxlength="180">{{ old('description') }}</textarea>
                                            <span class="fs-7 text-muted">Açıklama maksimum girilcek karakter sayısı 180'dir
                                                fazlası uygun değildir</span>
                                        </div> --}}

                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">@lang('cms.link_type')</label>
                                            <select class="form-select fw-bold" data-kt-select2="true"
                                                data-prev-value="{{ old('link_type') }}"
                                                data-placeholder="@lang('cms.link_type')" data-allow-clear="true"
                                                name="link_type" id="link_type" data-hide-search="true">
                                                <option value=""></option>
                                                <option @selected(old('link_type') == '3') value="3">Blog</option>
                                            </select>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">@lang('cms.link')</label>
                                            <select class="form-select fw-bold" data-kt-select2="true"
                                                data-prev-value="{{ old('link') }}" data-placeholder="@lang('cms.link')"
                                                data-allow-clear="true" name="link" id="link"
                                                data-hide-search="true">
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer" style="padding:1rem 2.25rem !important;">
                                <button class="btn  btn-primary">@lang('cms.' . $model) {{ TITLE_CREATE }}</button>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#title_small').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });
            $('#title_big').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });

            $('#description').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });


            $('#link_type').on('change', function() {
                var selected_value = $(this).val();
                $(this).data('prev-value', selected_value);
                $.ajax({
                    url: route('admin.slider.link_type', selected_value),
                    method: 'GET',
                    data: {
                        selected_value: selected_value
                    },
                    success: function(response) {
                        var new_select_options = '<option value=""></option>';
                        $.each(response.data, function(index, value) {
                            console.log(value.id);
                            new_select_options += '<option value="' + value.id + '">' +
                                value.title + '</option>';
                        });
                        $('#link').html(new_select_options).select2();

                        var prevValueLink = $('#link').data('prev-value');
                        $('#link').select2();
                        if (prevValueLink !== '') {
                            $('#link').val(prevValueLink).trigger('change');
                        }

                        $('#link').on('change', function() {
                            var selected_value = $(this).val();
                            $(this).data('prev-value',
                                selected_value); // Seçili değeri sakla
                        });
                    },
                    error: function() {
                        alert('Bir hata oluştu!');
                    }
                });
            });

            var prevValue = $('#link_type').data('prev-value');
            $('#link_type').select2();
            if (prevValue !== '') {
                $('#link_type').val(prevValue).trigger('change');
            }

        });


        let noimage =
            "{{ asset('noimage.jpg') }}";

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", noimage);
            }
        }
    </script>
@endsection
