@extends('admin.layout.master')
@section('title', 'Sản phẩm')
@section('content')
    <section class="container-fluid ">
        <div class="card">
            <div class="card-header">
                <h1 class="card-header__title"> Danh sách sản phẩm </h1>
                <div class="card-header__end">
                    <a class="btn-a" href="admin/product" data-bs-toggle="tooltip" title="Sản phẩm">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                    <a class="btn-div" href="admin/product/create">
                        <i class="fa-solid fa-circle-plus"></i> Thêm sản phẩm
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-striped w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm <i class="bi bi-search"></i></th>
                        <th>Hình ảnh</th>
                        <th>Trạng thái</th>
                        <th>Actions</th>
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
                "scrollX": true,
                "lengthMenu": [
                    [10, 50, 200, -1],
                    [10, 50, 200, "All"]
                ],
                language: datatable_language,
                ajax: '/admin/product/dataTableProduct',
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
                        data: 'image',width: '100px',className: 'text-center', searchable:false
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
        status('admin/product');
        destroy('admin/product');
    </script>
@endpush
