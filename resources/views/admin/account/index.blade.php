@extends('admin.layout.master')
@section('title', 'Tài khoản admin')
@section('content')
    <section class="container-fluid ">
        <div class="card my-3">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <h4 class="fs-5 my-0"> Danh sách tài khoản </h4>
                <div class="d-flex align-items-center float-end">
                    <a class="badge text-secondary me-2 text-decoration-none" href="admin/account" data-bs-toggle="tooltip" title="Danh sách tài khoản">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                    @if (auth()->guard('admin')->user()->hasAnyPermission('super-add'))
                        <a class="badge bg-secondary me-2 p-2 text-decoration-none" href="admin/account/create">
                            <i class="fa-solid fa-circle-plus"></i> Tạo tài khoản
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên tài khoản <i class="bi bi-search"></i></th>
                        <th>Email <i class="bi bi-search"></i></th>
                        <th>Điện thoại</th>
                        <th>Avatar</th>
                        <th>Trạng thái</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </section>
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
                // "scrollX": true,
                "lengthMenu": [
                    [10, 50, 200, -1],
                    [10, 50, 200, "All"]
                ],
                language: datatable_language,
                ajax: '/admin/account/dbaccount',
                "drawCallback": function(settings, json) {
                    $('[data-bs-toggle="popover"]').popover();
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    $('[data-toggle="toggle"]').bootstrapToggle('');
                },
                columns: [
                    {
                        data: 'id', width: '15px',searchable:false
                    },
                    {
                        data: 'name', width: '200px',searchable:true
                    },
                    {
                        data: 'email', width: '250px',searchable:true
                    },
                    {
                        data: 'phone', width: '150px',className: 'text-md-center',searchable:false
                    },
                    {
                        data: 'avatar',width: '100px',className: 'text-center', searchable:false
                    },
                    {
                        data: 'status', width: '100px',className: 'text-center',searchable:false
                    },
                    {
                        data: 'action', width: '100px',className: 'text-center',searchable:false
                    }
                ],
                "ordering": false,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndexFull + 1;
                    $('td:eq(0)', nRow).html(index);
                    return nRow;
                },
            });
        });
    </script>
    <script>
        status('admin/account');
        destroy('admin/account');
    </script>
@endpush
