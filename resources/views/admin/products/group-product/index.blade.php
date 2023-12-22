@extends('admin.layout.master')
@section('title', 'Nhóm sản phẩm')
@section('content')
    <section class="container-fluid ">
        <div class="card my-3">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h4 class="fs-6 my-0"> Danh sách nhóm sản phẩm </h4>
                </div>
                <div class="d-flex align-items-center float-end">
                    <a class="badge text-secondary me-1 text-decoration-none" href="admin/group-product" data-bs-toggle="tooltip" title="Danh mục nhóm sản phẩm">
                        <i class="fa-solid fa-rotate"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-5 border-top border-3 border-secondary rounded">
                        <div class="d-inline-block">
                            <div class="btn btn-xs btn-primary mt-3 p-2 text-decoration-none btn-edit" data-bs-toggle="modal" data-bs-target="#saveModal" data-toggle="tooltip" title="Thêm danh mục gốc">
                                <i class="fa-solid fa-circle-plus"></i> Thêm danh mục gốc
                            </div>
                            <div class="btn btn-sm btn-outline-warning mt-3" id="closeExpand" data-bs-toggle="tooltip" title="Xem / đóng tất cả danh mục con">
                                <i class="fa-solid fa-expand"></i> Xem / thu gọn danh mục con
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm">
                                <ol class="list-cat" id="sortable-menu">
                                    @foreach($groupproducts as $category)
                                        @include('admin.products.group-product.tree-item', ['category' => $category])
                                    @endforeach
                                </ol>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('admin.products.group-product.modal')
@endsection
@push('livecode-css')
<style>
    .list-cat {
        list-style-type: none;
        padding-left: 30px;
    }
    .list-cat-item {
        padding: 5px 0px 1px 10px;
        margin: 3px -2px;
        border: 2px solid aliceblue;
        cursor: move;
    }
</style>
@endpush
@push('livecode-js')
    <script src="vendor/jquery-ui/jquery-ui-1.10.4.min.js"></script>
    <script src="vendor/jquery-ui/jquery.mjs.nestedSortable.js?v={{ time() }}"></script>
<script>
    $(document).ready(function () {
        $('#closeExpand').click(function (e) {
            $('.list-cat').each(function (index, element) {
                $(element).toggleClass('show');
            });
        });
        $('#sortable-menu').nestedSortable({
            disableNesting: 'no-nest',
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            maxLevels: 5,
            opacity: .6,
            placeholder: 'placeholder',
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            update: function (event, ui) {
                var arrGetID = [];
                var arrElement = ui.item.siblings().addBack();
                arrElement.each(function( index ) {
                    arrGetID.push($( this ).data('id'));
                });

                var updatedItem = ui.item;
                var itemId = updatedItem.data('id');
                var parentElement = updatedItem.parents('.list-cat-item');
                var parentId = parentElement.data('id');
                $.post("admin/group-product/ajaxMove", { parent_id: parentId, id: itemId, arr_id: arrGetID} )
                .done(function(result) {
                    swal_condition(result);
                })
                .fail(function() {
                    swal_condition('error');
                });
            }
        });
    });

</script>
    <script>

        $('body').on('click','.btn-edit',function (e) {
            $('#parent_id').empty();
            $('#parent_id').append(`<option selected="selected" value="0">ROOT CATEGOTY</option>`);
            var parent_id = $(this).attr('data-parent');
            var id = $(this).attr('data-id');
            $.post("admin/group-product/ajaxList", { parent_id: parent_id, id: id} )
            .done(function(data) {
                if (data[1].id) {
                    $('#id_input').val(data[1].id);
                    $('#name').val(data[1].name);
                    $('#saveModal .modal-title').html(
                        `<b>Sửa danh mục: </b> <span class='text-danger'>${data[1].name}</span>`
                    );
                }else{
                    $('#saveModal .modal-title').html(`Thêm danh mục`);
                }
                data[0].forEach(category => {
                    perSelectCat(category,data[1].parent_id);

                });
                function perSelectCat(category,id,char = '') {
                    var selected = category.id == id ? 'selected' : '';
                    var option = `<option value="${category.id}" ${selected}>
                            ${char} ${category.name}
                        </option>`;
                    $('#parent_id').append(option);
                    if (category.children) {
                        category.children.forEach(subcategory => {
                            perSelectCat(subcategory,id,char+'|---');
                        });
                    }
                }
            })
            .fail(function() {
                swal_condition('error');
            });
        });
    </script>
    <script>
        status('admin/group-product');
        destroy('admin/group-product');
        $('.singleSelect2').select2({
            theme: 'bootstrap-5',
            allowClear: false
        });
    </script>
@endpush
