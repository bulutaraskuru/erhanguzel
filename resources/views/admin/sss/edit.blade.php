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
                        <form action="{{ route('admin.' . $model . '.update', ['id' => $data->id]) }}" method="POST">
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
                                    <div class="col-md-12">
                                        <div class="mb-5">
                                            <label for="exampleFormControlInput1"
                                                class="required form-label">@lang('cms.question')</label>
                                            <input type="text" class="form-control" required name="question"
                                                value="{{ old('question', $data->question) }}" id="question" maxlength="120" />
                                            <span class="fs-7 text-muted">Maksimim 120 karakter kullanabilirsiniz</span>
                                        </div>

                                        <div class="mb-5">
                                            <label class=" required form-label">@lang('cms.answer')</label>
                                            <textarea class="form-control" rows="8" required name="answer" id="answer" maxlength="280">{{ old('answer', $data->answer) }}</textarea>
                                            <span class="fs-7 text-muted">Maksimim 280 karakter kullanabilirsiniz</span>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#question').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });
            $('#answer').maxlength({
                warningClass: "badge badge-success",
                limitReachedClass: "badge badge-danger"
            });

        });

    </script>
@endsection
