@extends('admin.layout.master')
@section('title', 'Nhóm quyền')
@section('content')
    <section class="container-fluid ">
        <div class="card">
            <div class="card-header">
                <h1 class="card-header__title">Nhóm quyền</h1>
                <div class="card-header__end">
                    <a class="btn-a" href="admin/permission" data-bs-toggle="tooltip"
                        title="Nhóm quyền">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                    <div class="btn-div" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fa-solid fa-circle-plus"></i> Thêm nhóm quyền
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên nhóm</th>
                            <th>Mô tả nhóm</th>
                            <th>Sắp xếp</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @include('admin.permission.modal-role')
@endsection
@push('livecode-css')
@endpush
@push('livecode-js')
    <script>
        $(function() {
            $.fn.dataTable.ext.errMode = 'throw';
            $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                "lengthMenu": [
                    [10, 50, 200, -1],
                    [10, 50, 200, "All"]
                ],
                language: datatable_language,
                ajax: `admin/permission/db_role`,
                "drawCallback": function(settings, json) {
                    $('[data-bs-toggle="popover"]').popover({
                        trigger: 'hover click',
                    });
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    $('[rel="tooltip"]').tooltip();
                },
                "rowCallback": function(row, data) {
                    $.ajax({
                        url: 'admin/permission/ajax-role-account/' + data.id,
                        error: function(){
                            $('td:eq(4) .btn-popover', row).html(`<div class="badge text-warning">
                                <i class="fa-solid fa-grip-vertical"></i></div>`).tooltip({
                                    html: true,
                                    title: 'Tải lỗi'
                                });
                        },
                        success: function(result){
                            setTimeout(function() {
                                var resultorder = '';
                                result.forEach(element => {
                                    resultorder += `<a class="d-block text-dark text-decoration-none" href="admin/permission/model/?model_id=${element.model_id}">
                                                <i class="fa-solid fa-user"></i> ${element.name}
                                            </a>`;
                                });
                                $('td:eq(4) .btn-popover', row).popover({
                                    html: true,
                                    trigger:'hover click',
                                    title: `Xem người dùng <b class='text-uppercase'>${data.name}</b>`,
                                    content: `${resultorder}`
                                });

                            }, 300);
                        }
                    });
                },
                columns: [{
                        data: 'id',
                        width: '15px',
                        searchable: false
                    },
                    {
                        data: 'name',
                        width: '200px',
                        searchable: true
                    },
                    {
                        data: 'description',
                        width: 'auto',
                        searchable: true
                    },
                    {
                        data: 'sort',
                        width: '50px',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'action',
                        width: '150px',
                        className: 'text-center',
                        searchable: false
                    },

                ],
                "ordering": false,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndexFull + 1;
                    $('td:eq(0)', nRow).html(index);
                    return nRow;
                },
            });
        });

        destroy('admin/permission');
    </script>
@endpush
