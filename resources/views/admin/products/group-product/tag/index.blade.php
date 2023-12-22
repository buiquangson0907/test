@extends('admin.layout.master')
@section('title', 'Nhóm sản phẩm')
@section('content')
    <section class="container-fluid ">
        <form method="POST" action="admin/group-product/tag/saveData" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="card my-3">
                <div class="card-header d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fs-6 my-0"> Danh sách nhóm sản phẩm </h4>
                    </div>
                    <div class="d-flex align-items-center float-end">
                        <a class="badge text-secondary me-1 text-decoration-none" href="admin/group-product" data-bs-toggle="tooltip" title="Danh mục nhóm sản phẩm">
                            <i class="fa-solid fa-rotate"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary nutluu">
                            <i class="fa-solid fa-floppy-disk"></i> Lưu thẻ
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8 border-top border-3 border-secondary rounded">
                            <div class="row mt-3">
                                <div class="col-12 col-sm">
                                    <select class="form-select singleSelect2" name="group_product_id" id="group_product_id">
                                        {{ VHNMenu::showSelectCat($groupproducts,$id) }}
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    @foreach ($grouptags as $item)
                                        @include('admin.products.group-product.tag.tree-item', ['item' => $item])
                                        <hr class="text-warning">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
@push('livecode-css')

@endpush
@push('livecode-js')
<script>
    $('#group_product_id').change(function (e) {
        var id = $(this).val();
            window.location.assign(`admin/group-product/tag/${id}`);
        });
        $('.singleSelect2').select2({
            theme: 'bootstrap-5',
            allowClear: false
        });
    </script>
@endpush
