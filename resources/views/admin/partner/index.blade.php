@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('cms/assets/css/lightbox.css') }}">
    <style>
        table .gy-5 {
            padding: 0.3rem !important;
        }
    </style>
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid py-2 py-lg-3">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="card">
                    @include('admin.partner.component.card-header')
                    <div class="card-body py-4">
                        <table class="table table-hover table-striped align-middle table-row-dashedr gy-5" id="table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bold ">
                                    <th class="w-40px pe-2">#</th>
                                    <th class="w-75px">@lang('cms.img')</th>
                                    <th class="w-225px">@lang('cms.title')</th>
                                    <th class="w-125px">@lang('cms.created_at')</th>
                                    <th class="w-125px">@lang('cms.updated_at')</th>
                                    <th class="w-125px">@lang('cms.is_active')</th>
                                    <th class="text-center w-150px">@lang('cms.action')</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <tbody class="text-gray-600 fw-semibold" id="tablecontents">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
    <script src="{{ asset('cms/assets/js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                serverSide: true,
                responsive: true,
                fixedHeader: true,
                deferRender: true,
                stateSave: true,
                searching: false,
                paging: false,
                ordering: true,
                language: {
                    "url": "{{ asset('cms/assets/js/Turkish.json') }}",
                },
                ajax: {
                    type: 'GET',
                    url: route('admin.partner.data'),
                    data: function(d) {
                        d.text = $('#text').val(),
                            d.is_active = $('#is_active').val()
                    }
                },
                order: [
                    [1, "desc"]
                ],
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        data: 'img',
                        name: 'img'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },

                    {
                        data: 'is_active',
                        name: 'is_active',
                        className: 'text-center',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('row1');
                    $(row).attr('data-id', data.id);
                },
                initComplete: function() {
                    $('#text').bind('keyup', function(e) {
                        var code = e.keyCode || e.which;
                        if (code == 13) {
                            $('#table').DataTable().draw(true);
                        }
                    });
                },
            });

            table.on('draw', function() {
                var pageInfo = table.page.info();
                var currentPage = pageInfo.page + 1;
                $('#table tbody tr').each(function(index) {
                    $(this).addClass('page-1');
                    $(this).addClass('row1');
                });
            });


            $('#searct_button').click(function(res) {
                $('#table').DataTable().draw(true);
            });


            $('#text').keyup(function() {
                $("#reset_text").removeClass('d-none');
                if ($(this).val() == '') {
                    $("#reset_text").addClass('d-none');
                }
                $('#table').DataTable().draw(true);
            });


            $('#kt_customers_export_cancel').click(function(e) {
                $('#kt_customers_export_modal').modal('hide');
            });

            $('#reset_filter_button').click(function(e) {
                e.preventDefault();
                $('#text').val("");
                $("#is_active").val('all').trigger('change');
                $('#table').DataTable().draw(true);
            });



            $(document).on('click', '.deleteButton', function() {
                event.preventDefault();
                var ID = $(this).attr('id');
                $.ajax({
                    url: route('admin.partner.destroy', {
                        id: ID
                    }),
                    type: 'GET',
                    success: function(data) {
                        $('#table').DataTable().draw(true);
                        var successText = "Başarılı, " +
                            "{{ $model_text }} silinmiştir.";
                        toastMixin.fire({
                            showClass: true,
                            title: successText,
                            icon: 'info'
                        });
                    },
                    error: function(data) {
                        toastMixin.fire({
                            showClass: true,
                            title: "{{ Lang::get('cms.successTitle') }}",
                            icon: 'success'
                        });
                    }
                });
            });

            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });
        });

        function sendOrderToServer() {
            var order = [];
            $('tr.row1').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            console.log(order);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: route('admin.partner.sortable'),
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#table').DataTable().draw(true);
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });

        }
    </script>
@endsection
