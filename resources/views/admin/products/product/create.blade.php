@extends('admin.layout.master')
@section('title', 'Sản phẩm')
@section('content')
    <section class="container-fluid ">
        <form method="POST" action="admin/product/store" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">

                    <h1 class="card-header__title"> Thêm sản phẩm </h1>

                    <div class="card-header__end">
                        <a class="btn-a" href="admin/product" data-bs-toggle="tooltip" title="Sản phẩm">
                            <i class="fa-solid fa-backward"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary nutluu">
                            <i class="fa-solid fa-floppy-disk"></i> Lưu sản phẩm
                        </button>
                    </div>
                </div>
                <div class="card-body">
                        @include('admin.products.product.navtabs.navtab-wrap')
                </div>
            </div>
        </form>
    </section>
@endsection
@push('livecode-css')
@endpush
@push('livecode-js')
    <script src="template/admin/js/inputfile/fileSingleInput.js?v={{ time() }}"></script>
    <script src="template/admin/js/inputfile/fileMultipleInput.js?v={{ time() }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button-product.js?v={{ time() }}"></script>
    <script src="/template/admin/js/product/product.js?v={{ time() }}"></script>
@endpush
