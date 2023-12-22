@extends('admin.layout.master')
@section('title', 'Tài khoản admin')
@section('content')
    <section class="container-fluid ">
        <div class="card">
            <div class="card-header">
                <h1 class="card-header__title">
                     Quyền của <b class="text-warning">{{ $model->name}}</b>
                </h1>
                <div class="card-header__end">
                    <a class="btn-a" href="admin/permission/model" data-bs-toggle="tooltip" title="Vai trò & người dùng">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body__border">
                    <form method="POST" action="admin/permission/model" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center mb-5">
                            <div class="col-xl-3 p-2 bg-light border rounded align-self-baseline">
                                <h4 class="fs-6 text-uppercase text-center fw-bold">Thông tin chọn người dùng</h4>
                                <select class="singleSelect2 form-select" name="model_id" id="model_id">
                                    @foreach ($models as $item)
                                        <option @if ($model->id == $item->id) selected @endif value="{{ $item->id }}"
                                            @if (!$item->model_id) disabled="disabled" @endif >
                                            {{$item->name}} - {{ $item->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-group">
                                    <li class="list-group-item bg-light fw-bold">
                                        <i class="fa-solid fa-user-check"></i> {{ $model->name}} - ({{ $model->email }})
                                    </li>
                                    @foreach ($modelroles as $role)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="form-check" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Chọn nhóm quyền">
                                            <input class="form-check-input check-warning" name="check_role" value="{{ $role->id }}" type="radio" @if ($role->role_id) checked @endif id="role{{$role->id}}" >
                                            <label class="form-check-label" for="role{{$role->id}}"> {{$role->description}} </label>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            @if ($role->id == $model->role_id)
                                                <div class="text-warning " data-bs-toggle="tooltip" title="Nhóm quyền hiện tại">
                                                    <i class="fa-solid fa-flag"></i>
                                                </div>
                                            @endif
                                            <a href="admin/permission/role?role_id={{ $role->id }}" data-bs-toggle="tooltip" title="xem nhóm quyền"
                                                class="ms-1 badge bg-light text-dark rounded-pill text-decoration-none">
                                                xem
                                           </a>
                                           <div class="btn btn-xs btn-edit-modal" data-bs-toggle="tooltip" data-id="{{ $role->id }}" title="Sửa nhóm quyền">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                        @foreach ($modelpermissions as $key => $permission)
                            @php
                                $key_permission = explode('-',$key);
                            @endphp
                            <div class="row g-0 mt-3 border-1 border-bottom">
                                <div class="col-xl-2">
                                    <h6 class="badge border border-1 text-dark">
                                        <i class="fa-solid fa-ban"></i> Loại quyền:
                                        @isset($key_permission[1])
                                            <span class="text-warning"> {{ $key_permission[1] }} </span>
                                        @endisset
                                    </h6>
                                </div>
                                <div class="col-xl-10">
                                    <div class="d-flex flex-wrap">
                                    @foreach ($permission as $item)
                                        @if ($item->role_permission)
                                            <div class="d-flex align-items-center ms-3">
                                                <div class="d-inline-block" data-bs-toggle="popover" data-bs-html="true"
                                                    data-bs-content="<p >Thuộc người dùng <b class='text-warning'>{{ $model->name }}</b> </p> Mã: {{ $item->name }}">
                                                    <span class="text-warning">
                                                        <i class="fa-solid fa-ban"></i> {{$item->description}}
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center ms-3">
                                                <div class="form-check d-inline-block" data-bs-toggle="popover" data-bs-html="true"
                                                    data-bs-content="<p >Vào người dùng <b class='text-primary'>{{ $model->name}}</b></p> Mã: {{ $item->name }}">
                                                    <input class="form-check-input check-primary" type="checkbox" name="check_permission[{{ $item->name }}]"
                                                        @if ($item->permission_id) checked @endif id="per{{$item->id}}"
                                                    >
                                                    <label class="form-check-label" for="per{{$item->id}}">
                                                        {{$item->description}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-sm btn-primary float-end">
                                <i class="fa-solid fa-floppy-disk"></i> Xác nhận
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('admin.permission.modal-role')
@endsection
@push('livecode-css')
@endpush
@push('livecode-js')
    <script>
        $('input[name="check_role"]').change(function (e) {
            var model_id = $('select[name="model_id"]').val();
            var role_id = $(this).val();
            window.location.assign(`admin/permission/model?model_id=${model_id}&role_id=${role_id}`);
        });
        $('select[name="model_id"]').change(function (e) {
            var model_id = $(this).val();
            var role_id = $('input[name="check_role"]:checked').val();
            window.location.assign(`admin/permission/model?model_id=${model_id}&role_id=${role_id}`);
        });
    </script>
@endpush
