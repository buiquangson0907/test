@extends('admin.layout.master')
@section('title', 'Cài đặt trang chủ')
@section('content')
    <section class="container-fluid ">
        <div class="card my-3">
            <div class="card-header d-md-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h4 class="fs-6 my-0"> Cài đặt trang chủ </h4>
                </div>
                <div class="d-flex align-items-center float-end">
                    <a class="badge text-secondary me-1 text-decoration-none" href="admin/set_home" data-bs-toggle="tooltip" title="Cài đặt danh mục trang chủ">
                        <i class="fa-solid fa-rotate"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-5 border-top border-3 border-secondary rounded">
                        <div class="d-inline-block">
                            <div class="btn btn-sm btn-outline-warning mt-3" id="closeExpand" data-bs-toggle="tooltip" title="Xem / đóng tất cả danh mục con">
                                <i class="fa-solid fa-expand"></i> Xem / thu gọn danh mục con
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm">
                                <ol class="list-cat" id="sortable-menu">
                                    @foreach($groupproducts as $category)
                                        @include('admin.setups.setup-home.tree-item', ['category' => $category])
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
            maxLevels: 2,
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
                $.post("admin/set_home/ajaxMove", { parent_id: parentId, id: itemId, arr_id: arrGetID} )
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
        status('admin/set_home');
        destroy('admin/set_home');
    </script>
@endpush
