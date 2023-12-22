<!-- Modal -->
<div class="modal fade" id="saveModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Thêm Danh mục</h6>
                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <form method="POST" action="admin/group-tag/saveData" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id_input">
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="name" class="fw-bold badge text-dark">Tên danh mục (*)</label>
                        </div>
                        <div class="col-12">
                            <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="Tên danh mục">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="parent_id" class="fw-bold badge text-dark">Danh mục cha (*)</label>
                        </div>
                        <div class="col-12">
                            <select class="form-select form-select-sm singleSelect2" name="parent_id" id="parent_id">
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-check ps-0">
                                <input id="status" name="status" class="form-check-input" type="checkbox"
                                    data-on="<i class='fa fa-play'></i> phát hành" data-off="<i class='fa fa-pause'></i> Ngưng hoạt động"
                                    data-width="120" data-toggle="toggle" data-size="sm" data-onstyle="dark" data-offstyle="light" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Lưu danh mục
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
