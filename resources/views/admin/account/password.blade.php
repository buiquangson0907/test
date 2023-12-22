@extends('admin.layout.master')
@section('title', 'Tài khoản admin')
@section('content')
    <section class="container-fluid ">
        <form method="POST" action="admin/account/password" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card my-3">
                <div class="card-header d-md-flex justify-content-between align-items-center">
                    <h4 class="fs-5 my-0"> Mật khẩu tài khoản </h4>
                    <div class="d-flex align-items-center">
                        <a class="badge text-secondary me-2 text-decoration-none" href="admin/account">
                            <i class="fa-solid fa-arrow-rotate-left"></i> Về danh sách
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top border-1 rounded border-secondary bg-light py-3 px-2">
                                <h5 class="fs-6 text-warning">Thay đổi mật khẩu tài khoản</h5>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6 bg-form">
                                        <div class="col-md-12 mt-2">
                                            <div class="d-inline mt-5">
                                                <label class="fw-bold badge text-dark text-capitalize">
                                                    <i class="fa-solid fa-key"></i> Mật khẩu
                                                </label>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="input-group input-group-sm flex-wrap mt-2">
                                                    <input type="text" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới">
                                                    <span class="input-group-text" style="width: 140px;">
                                                        <i class="fa-solid fa-lock"></i> &nbsp; Mật khẩu
                                                    </span>

                                                </div>
                                                <div class="input-group input-group-sm flex-wrap mt-2">
                                                    <input type="text" autocomplete="off" name="passwordagain" id="passwordAgain" class="form-control bg-light" placeholder="Xác nhận mật khẩu mới">
                                                    <span class="input-group-text" style="width: 140px;">
                                                        <i class="fa-solid fa-lock"></i> &nbsp; Xác nhận MK
                                                    </span>
                                                </div>
                                                <div class="input-group flex-wrap mt-2">
                                                    <button class="btn btn-sm btn-outline-primary" type="button" onclick="genPassword()" data-bs-toggle="tooltip" data-bs-original-title="Tạo mật khẩu ngẫu nhiên">
                                                        <i class="fa-regular fa-keyboard"></i> Tạo mật khẩu
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="copyPassword()" data-bs-toggle="tooltip" data-bs-original-title="Copy mật khẩu">
                                                        <i class="fa-solid fa-copy"></i> Copy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-5">
                                            <button type="submit" class="btn btn-primary float-end nutluu">
                                                <i class="fa-solid fa-floppy-disk"></i> Thay đổi mật khẩu
                                            </button>
                                        </div>
                                    </div>
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
    <script src="template/admin/js/account/genpassword.js?v={{ time() }}"></script>
@endpush
