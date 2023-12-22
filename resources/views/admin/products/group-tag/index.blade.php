@extends('admin.layout.master')
@section('title', 'Nhóm thẻ')
@section('content')
    <section class="container-fluid ">
        <div class="card my-3">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h4 class="fs-6 my-0"> Danh sách Thẻ </h4>
                </div>
                <div class="d-flex align-items-center float-end">
                    <a class="badge text-secondary me-1 text-decoration-none" href="admin/group-tag" data-bs-toggle="tooltip" title="Danh mục Thẻ">
                        <i class="fa-solid fa-rotate"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-5 border-top border-3 border-secondary rounded">
                        <div class="d-inline-block">
                            <div class="btn btn-xs btn-primary mt-3 p-2 text-decoration-none btn-edit" data-bs-toggle="modal" data-bs-target="#saveModal" data-toggle="tooltip" title="Thêm thẻ gốc">
                                <i class="fa-solid fa-circle-plus"></i> Thêm danh mục thẻ
                            </div>
                            <div class="btn btn-sm btn-outline-warning mt-3" id="closeExpand" data-bs-toggle="tooltip" title="Xem / đóng tất cả thẻ con">
                                <i class="fa-solid fa-expand"></i> Xem / thu gọn thẻ con
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm">
                                <ol class="list-cat" id="sortable-menu">
                                    @foreach($grouptags as $item)
                                        @include('admin.products.group-tag.tree-item', ['item' => $item])
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('admin.products.group-tag.modal')
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
                $.post("admin/group-tag/ajaxMove", { parent_id: parentId, id: itemId, arr_id: arrGetID} )
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
            $.post("admin/group-tag/ajaxList", { parent_id: parent_id, id: id} )
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
                data[0].forEach(item => {
                    perSelectCat(item,data[1].parent_id);

                });
                function perSelectCat(item,id,char = '') {
                    var selected = item.id == id ? 'selected' : '';
                    var option = `<option value="${item.id}" ${selected}>
                            ${char} ${item.name}
                        </option>`;
                    $('#parent_id').append(option);
                    if (item.children) {
                        item.children.forEach(subitem => {
                            perSelectCat(subitem,id,char+'|---');
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
        status('admin/group-tag');
        destroy('admin/group-tag');
        $('.singleSelect2').select2({
            theme: 'bootstrap-5',
            allowClear: false
        });
    </script>
@endpush
