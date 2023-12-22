<!-- Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Thêm loại quyền</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="admin/permission/group/storeGroupPermission" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="group">
                <div class="modal-body">
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Tên loại quyền (*)
                        </label>
                        <input type="text" name="name" value="" class="form-control"
                            placeholder="Nhập tên loại quyền">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Mô tả loại quyền
                        </label>
                        <input type="text" name="description" value="" class="form-control"
                            placeholder="Nhập mô loại quyền">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> sắp xếp
                        </label>
                        <input type="number" name="sort" min="1" max="99">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Thêm vào
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Sửa tên phân loại quyền</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="group">
                <input type="hidden" name="oldname">
                <input type="hidden" name="name">
                <div class="modal-body">
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Tên phân loại quyền (*)
                        </label>
                        <input type="text" name="namedisabled" value="" class="form-control"
                            placeholder="Nhập tên loại quyền">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Mô tả phân loại quyền
                        </label>
                        <input type="text" name="description" value="" class="form-control"
                            placeholder="Nhập mô tả loại quyền">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> sắp xếp
                        </label>
                        <input type="number" name="sort" min="1" max="99">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Cập nhật
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="moveModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Sắp xếp theo loại quyền</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mt-2 d-flex justify-content-between">
                        <label for="move" class="text-info fw-bold text-center" id="label">Chọn một loại quyền</label>
                        <span><i class="fa-solid fa-arrow-right-arrow-left"></i></span>
                        <div id="move" class="w-50"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Cập nhật
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@push('livecode-js')
<script>
    $("body").on('click','.btn-edit-modal',function(){
        $("#editModal").modal("show");
        var group_id = $(this).attr('data-id');
        $.ajax({
            url: `admin/permission/group/ajaxGroupPermission/${group_id}`,
            error: function(){
                swal_condition(['error','không tải dữ liệu']);
            },
            success: function(data){
                setTimeout(function() {
                    $('#editModal input[name="name"]').val(data.name);
                    $('#editModal input[name="namedisabled"]').val(data.name).attr("disabled", true);
                    $('#editModal input[name="oldname"]').val(data.name);
                    $('#editModal input[name="description"]').val(data.description);
                    $('#editModal input[name="sort"]').val(data.sort);
                    $('#editModal form').attr('action',`admin/permission/group/updateGroupPermission/${data.name}`);
                }, 100);
            }
        });
    });
    $("body").on('click','.btn-move-modal',function(){
        $("#moveModal").modal("show");
        var permission_id = $(this).attr('data-id');

        $('#moveModal form').attr('action',`admin/permission/group/postGroupPermission/${permission_id}`);
        $('#move').empty();
        $.ajax({
            url: `admin/permission/group/getGroupPermission/${permission_id}`,
            error: function(){
                console.log( 'load error' );
            },
            success: function(data){
                setTimeout(function() {
                    data.forEach(element => {
                        var content = `<div class="d-flex"> <div class="form-check">
                            <input class="form-check-input check-warning" name="move" value="${element.name}" type="radio" ${element.name == element.current ? 'checked' : ''}  id="move${element.name}" >
                            <label class="form-check-label fw-bold" for="move${element.name}"> ${element.description} </label>
                        </div> <span data-name="${element.name}" class="remove ms-2 text-dark pointer"><i class="fa-solid fa-trash-can"></i></span></div>`;
                        $('#move').append(content);
                        $('#label').text(element.permission_description);
                    });
                }, 100);
            }
        });
    });
    $(document).on('click','.remove',function () {
        var remove = $(this).attr('data-name');
        $.ajax({
            url: `admin/permission/group/removeGroupPermission/${remove}`,
            success: function(result){
                swal_condition(result);
            }
        });
    });
</script>
@endpush
