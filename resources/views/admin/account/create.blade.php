@extends('admin.layout.master')
@section('title', 'Tài khoản admin')
@section('content')
    <section class="container-fluid ">
        <form method="POST" action="admin/account/store" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card my-3">
                <div class="card-header d-md-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fs-5 my-0"> Tạo tài khoản </h4>
                    </div>
                    <div class="d-flex align-items-center float-end">
                        <a class="badge text-secondary me-2 text-decoration-none" href="admin/account" data-bs-toggle="tooltip" title="Danh sách tài khoản">
                            <i class="fa-solid fa-backward"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary nutluu">
                            <i class="fa-solid fa-floppy-disk"></i> Lưu tài khoản
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="border-top border-1 rounded border-secondary text-center bg-light py-3 px-2">
                                <h5 class="fs-6 text-start">
                                    Ảnh đại diện
                                </h5>
                                <div class="file-drop-area">
                                    <div class="drop-area">
                                        <span class="fake-btn"><i class="fa-solid fa-image"></i> Choose files</span>
                                        <span class="file-msg">or drop files here</span>
                                        <input class="dropfile" id="dropfileModal" type="file" multiple>
                                    </div>
                                    <div id="preview">
                                        <img src="" class="preview" alt="image">
                                        <input type="hidden" class="hiddenfile" name="avatar" />
                                        <div class="item-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="border-top border-1 rounded border-secondary bg-light py-3 px-2">
                                <h5 class="fs-6 text-warning">Thông tin tài khoản</h5>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-8 bg-form">
                                        <div class="col-md-12 mt-2">
                                            <label class="fw-bold badge text-dark text-capitalize mb-1">
                                                <i class="fa-solid fa-file-signature"></i> Tên tài khoản (**) <small class="text-danger"></small>
                                            </label>
                                            <input type="text" name="name" value="" class="form-control" placeholder="Nhập tên Tài khoản">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="fw-bold badge text-dark text-capitalize mb-1">
                                                <i class="fa-solid fa-envelope"></i> Địa chỉ email (**) <small class="text-danger"></small>
                                            </label>
                                            <input type="email" name="email" value="" class="form-control" placeholder="Nhập địa chỉ Email">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="fw-bold badge text-dark text-capitalize mb-1">
                                                <i class="fa-solid fa-phone-flip"></i> Điện thoại
                                            </label>
                                            <input type="text" name="phone" value="" class="form-control phonemask" placeholder="Nhập số điện thoại" inputmode="text">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="d-inline mt-5" data-bs-toggle="tooltip" title="Ẩn form nhập mật khẩu">
                                                <label class="fw-bold badge text-dark text-capitalize" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="true">
                                                    <i class="fa-solid fa-key"></i> Mật khẩu
                                                </label>
                                            </div>
                                            <div class="col-md-12 mt-2 collapse show" id="collapsePassword" style="">
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
                                        <div class="row mt-3">
                                            <div class="col-md-2">
                                                <label for="status" class="fw-bold badge text-dark">
                                                    <i class="fa-solid fa-flag-checkered"></i> Trạng thái
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check ps-0">
                                                    <input id="status" name="status" class="form-check-input" type="checkbox"
                                                        data-width="120" data-toggle="toggle" data-size="sm"
                                                        data-on="<i class='fa fa-play'></i> Mở" data-off="<i class='fa fa-pause'></i> Tắt"
                                                        data-onstyle="primary" data-offstyle="secondary"
                                                        checked
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-2">
                                                <label for="status" class="fw-bold badge text-dark">
                                                    <i class="fa-solid fa-flag-checkered"></i> Cấp quản lý
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="btn-group-vertical btn-group-sm w-100" role="group">
                                                    @if (auth()->guard('admin')->user()->role < 3)
                                                        <input type="radio" class="btn-check" name="role" value="3" id="role3" autocomplete="off" checked >
                                                        <label class="btn btn-outline-secondary fw-bold" for="role3"> <i class="fa-solid fa-user-gear"></i> Quản lý phổ thông </label>
                                                    @endif

                                                    @if (auth()->guard('admin')->user()->role < 2)
                                                        <input type="radio" class="btn-check" name="role" value="2" id="role2" autocomplete="off">
                                                        <label class="btn btn-outline-secondary fw-bold" for="role2"> <i class="fa-solid fa-user-gear"></i> Quản lý tài khoản </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if (auth()->guard('admin')->user()->hasAnyRole('super'))
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <label for="role_id" class="fw-bold badge text-dark">
                                                        <i class="fa-solid fa-flag-checkered"></i> Nhóm quyền
                                                    </label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="singleSelect21 form-select form-select-sm" name="role_id" id="role_id">
                                                        <option value="0">Không chọn</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->description }} {{ '('.$item->name.')' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
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
    <link rel="stylesheet" href="template/admin/css/inputfile.css?v={{ time() }}">
@endpush
@push('livecode-js')
    @include('admin.layout.cut-image')
    <script src="template/admin/js/inputfile/cropmodal.js?v={{ time() }}"></script>
    <script>
        cutimage(200, 200);
    </script>
    <script src="template/admin/js/account/genpassword.js?v={{ time() }}"></script>
    <script>
        $('.singleSelect2').select2({
            theme: 'bootstrap-5',
            allowClear: false
        });
    </script>
@endpush
