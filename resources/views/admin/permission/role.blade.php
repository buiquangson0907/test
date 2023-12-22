@extends('admin.layout.master')
@section('title', 'Quản lý quyền')
@section('content')
    <section class="container-fluid ">
        <div class="card">
            <div class="card-header">
                <h1 class="card-header__title"> Quản lý quyền</h1>
                <div class="card-header__end">
                    <a class="btn-a" href="admin/permission/role" data-bs-toggle="tooltip" title="Quản lý quyền">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="admin/permission/role" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 p-2 bg-light border rounded">
                            <h4 class="fs-6 text-uppercase text-center fw-bold">Thông tin chọn nhóm quyền</h4>
                            <select class="singleSelect2 form-select" name="role" id="role">
                                @foreach ($roles as $item)
                                    <option @if ($item->id == $role->id) selected @endif value="{{ $item->id }}">
                                        {{$item->description}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="btn btn-xs btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fa-solid fa-circle-plus"></i> Thêm phân loại quyền
                    </div>
                    @foreach ($permissions as $key => $permission)
                    @php
                        $key_permission = explode('-',$key);
                    @endphp
                    <div class="row g-0 mt-3 border-1 border-bottom">
                        <div class="col-xl-2">
                            <h6 class="badge border border-1 text-dark pointer btn-edit-modal" data-id="@isset($key_permission[0]){{ $key_permission[0] }}@endisset"
                                data-bs-toggle="tooltip" title="Sửa tên phân loại quyền" >
                                <i class="fa-regular fa-pen-to-square"></i> Loại quyền:
                                @isset($key_permission[1])
                                    <span class="text-warning"> {{ $key_permission[1] }} </span>
                                @else
                                    <span class="text-muted"> chưa xác định </span>
                                @endisset
                            </h6>
                        </div>
                        <div class="col-xl-10">
                            <div class="d-flex flex-wrap">
                                @foreach ($permission as $item)
                                    <div class="d-flex align-items-center ms-3">
                                        <div class="form-check d-inline-block" data-bs-toggle="popover" data-bs-html="true"
                                            data-bs-content="vào nhóm người dùng: <b class='text-warning'> {{ $role->description }} </b> <br>
                                                mã: ({{ $item->name }}) " >
                                            <input class="form-check-input check-warning" type="checkbox" name="check_permission[{{ $item->name }}]" @if ($item->permission_id) checked @endif id="per{{$item->id}}">
                                            <label class="form-check-label" for="per{{$item->id}}">
                                                {{$item->description}}
                                            </label>
                                        </div>
                                        <div class="btn btn-sm rounded text-primary btn-move-modal" data-id="{{ $item->id }}"
                                            data-bs-toggle="tooltip" title="sắp xếp - phân loại quyền">
                                            <i class="fa-solid fa-arrow-down-z-a"></i>
                                        </div>
                                    </div>
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
    </section>
    @include('admin.permission.modal-permission-group')
@endsection
@push('livecode-css')
@endpush
@push('livecode-js')
<script>
    $(function() {
        $('#role').change(function(e) {
            var role = $(this).val();
            window.location.assign('admin/permission/role?role_id=' + role);
        });
    });
</script>

@endpush
