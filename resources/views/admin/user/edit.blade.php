@extends('layouts.admin')

@section('style')
@endsection
@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
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
                    <a href="{{ route('admin.index') }}"
                        class="text-muted text-hover-primary">@lang('cms.dashboard')</a>
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
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
                <div class="card">
                    <form action="{{ route('admin.user.update',['id' => $data->id]) }}" method="POST">
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
                            <div class="mb-10">
                                <label for="exampleFormControlInput1"
                                    class="required form-label">@lang('cms.name')</label>
                                <input type="text" name="name" id="name" class="form-control form-control-solid"
                                    placeholder="@lang('cms.name')" value="{{ old('name',$data->name) }}" />
                            </div>

                            <div class="mb-10">
                                <label for="exampleFormControlInput1"
                                    class="required form-label">@lang('cms.email')</label>
                                <input type="email" name="email" id="email" class="form-control form-control-solid"
                                    placeholder="@lang('cms.email')"  value="{{ old('email',$data->email) }}"/>
                            </div>

                            <!--begin::Main wrapper-->
                            <div class="fv-row" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold fs-6 mb-2">
                                        @lang('cms.password')
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid" type="password"
                                            placeholder="" name="password" autocomplete="off" />

                                        <!--begin::Visibility toggle-->
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span></i>
                                            <i class="ki-duotone ki-eye d-none fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
                                        </span>
                                        <!--end::Visibility toggle-->
                                    </div>
                                    <!--end::Input wrapper-->

                                    <!--begin::Highlight meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Highlight meter-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Hint-->
                                <div class="text-muted">
                                    Harf, sayı ve sembol karışımıyla 8 veya daha fazla karakter kullanın.
                                </div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Main wrapper-->
                            <div class="mb-10">
                                <label for="exampleFormControlInput1"
                                    class="required form-label">@lang('cms.role')</label>
                                <select class="form-select form-select-solid" name="role" data-control="select2"
                                    data-placeholder="@lang('cms.role') @lang('cms.select')" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($roles as $role)
                                 <option @selected($user_role==$role->id) value="{{ $role->id }}">
                                        {{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card-footer" style="padding:1rem 2.25rem !important;">
                            <button class="btn btn-warning text-dark" >@lang('cms.user') {{ TITLE_UPDATE }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script></script>
@endsection