@extends('layouts.admin')
@section('style')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- style file import --}}
    <style>
        table .gy-5 {
            padding: 0.9rem !important;
        }
    </style>
@endsection
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="blog-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="blog-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ $model_text . ' ' . TITLE_LIST }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">@lang('cms.dashboard')
                                Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $model_text }} @lang('cms.module')</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--end::Row-->
                <div class="card col-md-8 col-sm-12 col-xs-12">
                    <!--begin::Card body-->
                    <div class="card-body pt-0" style="padding: px !important;">
                        <!--begin::Dropzone-->
                        <div class="dropzone mt-10 mb-10" id="kt_dropzonejs_example_1">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Tıklayın veya seçtiğiniz görselleri
                                        sürükleyip bırakabilirsiniz</h3>
                                    <span class="fs-7 fw-semibold text-gray-400">Tek seferde 10 adet görsel
                                        yükleyebilirsiniz</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <!--end::Dropzone-->

                        <!--begin::Table-->
                        <table class="table table-hover table-striped align-middle table-row-dashedr gy-5" id="table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold ">
                                    <th class="text-center w-70px">@lang('cms.img')</th>
                                    <th class="w-100px">@lang('cms.is_active')</th>
                                    <th class="text-end w-200px">@lang('cms.created_at')</th>
                                    <th class="text-center w-200px">@lang('cms.action')</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table he8d-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    </div>
@endsection
@section('script')
    {{-- script file import --}}
    <script>
        $(document).ready(function() {

            var toastMixin = Swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('admin.newimage.upload',
                "{{ $data->id }}"), // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 10,
                autoProcessQueue: true,
                maxFilesize: 10, // MB
                addRemoveLinks: false,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png",
                init: function() {
                    this.on('success', function() {
                        if (this.getQueuedFiles().length == 0 && this.getUploadingFiles()
                            .length == 0) {
                          $('#table').DataTable().draw(true);
                          this.removeAllFiles(true);
                        }
                    });
                },
                timeout: 50000,
                success: function(file, response) {
                    $('#table').DataTable().draw(true);
                },
                error: function(file, response) {
                    return false;
                }
            });


            $('form').on('click', '.form-text + .clear-text', function(e) {
                e.preventDefault();
                console.log('clear text.');
                $(this).prev('input').val('');
                return false;
            });

            var table = $('#table').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                responsive: true,
                fixedHeader: true,
                deferRender: true,
                stateSave: true,
                retrieve: true,
                searching: true,
                paging: true,
                ordering: true,
                language: {
                    "url": "{{ asset('cms/assets/js/Turkish.json') }}",
                },
                ajax: {
                    type: 'GET',
                    url: route('admin.newimage.data', "{{ $data->id }}"),
                },
                columns: [

                    {
                        data: 'img',
                        name: 'img',
                        className: 'text-center',
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                ],
                fnDrawCallback: function() {
                    $(".is_active").change(function() {
                        var is_active = $(this).prop("checked") == true ? 1 : 0;
                        var v_id = $(this).data("id");
                        var url = $(this).data("url");
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: url,
                            data: {
                                is_active: is_active,
                                v_id: v_id
                            },
                            success: function(data) {
                                if (data.dataVariable == 1) {
                                    toastMixin.fire({
                                        showClass: true,
                                        title: "Durumu aktif oldu",
                                        icon: 'success'
                                    });
                                } else if (data.dataVariable == 0) {

                                    toastMixin.fire({
                                        showClass: true,
                                        title: "Durumu pasif oldu",
                                        icon: 'error'
                                    });

                                }
                            },
                        });
                    });

                },
                fnCreatedRow: function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', 'eleman-' + aData.id);

                },
            });

            $(document).on('click', '.deleteButton', function() {
                event.preventDefault();
                var ID = $(this).attr('id');

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Silmek istediğinize eminmisiniz ?',
                    text: "Bu işlemi geri alamazsınız !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, Silmek İstiyorum!',
                    cancelButtonText: 'Hayır, İptal Et!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: route('admin.newimage.destroy', {
                                id: ID
                            }),
                            type: 'GET',
                            success: function(data) {
                                var successText =
                                    "{{ Lang::get('cms.success_title') }}" +
                                    "{{ Lang::get('cms.success_text_destroy') }}";
                                toastMixin.fire({
                                    showClass: true,
                                    title: successText,
                                    icon: 'success'
                                });
                                $('#table').DataTable().draw(true);
                            },
                            error: function(data) {
                                toastMixin.fire({
                                    showClass: true,
                                    title: "{{ Lang::get('cms.success_title') }}",
                                    icon: 'success'
                                });
                            }
                        })
                        swalWithBootstrapButtons.fire(
                            'Başarılı !',
                            'Kayıt Başarılı bir şekilde silindi.',
                            'success'
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Başarısız',
                            'Kayıt Silinmedi ...',
                            'error'
                        )
                    }
                })
            });
        });
    </script>
@endsection
