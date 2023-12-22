<!-- Modal -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Thêm nhóm quyền</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="admin/permission/storeRole" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="role">
                <div class="modal-body">
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Tên nhóm (*)
                        </label>
                        <input type="text" name="name" value="" class="form-control"
                            placeholder="Nhập tên nhóm">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Mô tả nhóm
                        </label>
                        <input type="text" name="description" value="" class="form-control"
                            placeholder="Nhập mô tả nhóm">
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
                <h6 class="modal-title">Sửa nhóm quyền</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="group">
                <input type="hidden" name="oldname">
                <div class="modal-body">
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Tên nhóm (*)
                        </label>
                        <input type="text" name="name" value="" class="form-control"
                            placeholder="Nhập tên nhóm">
                    </div>
                    <div class="mt-2">
                        <label class="fw-bold badge text-dark text-capitalize">
                            <i class="fa-solid fa-file-signature"></i> Mô tả nhóm
                        </label>
                        <input type="text" name="description" value="" class="form-control"
                            placeholder="Nhập mô tả nhóm">
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

@push('livecode-js')
    <script>
          $("body").on('click', '.btn-edit-modal', function() {
            $("#editModal").modal("show");
            var role_id = $(this).attr('data-id');
            $.ajax({
                url: `admin/permission/ajax-role/${role_id}`,
                error: function() {
                    console.log('load error');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#editModal input[name="name"]').val(data.name);
                        $('#editModal input[name="oldname"]').val(data.name);
                        $('#editModal input[name="description"]').val(data.description);
                        $('#editModal input[name="sort"]').val(data.sort);
                        $('#editModal form').attr('action',
                            `admin/permission/updateRole/${data.id}`);
                        if (data.id == 1) {
                            $('#editModal input[name="name"]').attr("disabled", true);
                        } else {
                            $('#editModal input[name="name"]').attr("disabled", false);
                        }
                    }, 100);
                }
            });
        });
    </script>
@endpush
