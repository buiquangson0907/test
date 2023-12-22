// Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: true,
    confirmButtonText: '<i class="fa-solid fa-rotate"></i> Đóng!',
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

var arrayAction = [
    {
        'idAlert' : 'success', 'actionAlert' : 'success', 'textAlert' : 'Thông báo thành công','htmlAlert' : false
    },
    {
        'idAlert' : 'error', 'actionAlert' : 'error', 'textAlert' : 'Thông báo lỗi','htmlAlert' : false
    },
    {
        'idAlert' : 'warning', 'actionAlert' : 'warning', 'textAlert' : 'Thông báo lỗi xác nhận', 'htmlAlert' : false
    },
    {
        'idAlert' : 'permission', 'actionAlert' : 'warning', 'textAlert' : 'Quền truy cập','htmlAlert' : false
    },
    {
        'idAlert' : 'cancel', 'actionAlert' : 'info', 'textAlert' : 'Dữ liệu an toàn','htmlAlert' : false, timerAlert : 800
    },
];
// call back swal
function swal_condition(result) {
    var result = Array.isArray(result) ? result : [result];
    var resultAction = result[0];
    result.splice(0, 1);
    var resultHTML = '';
    result.forEach(element => {
        resultHTML += '<p>'+element+'</p>';
    });
    arrayAction.forEach(el => {
        if(resultAction == el.idAlert) {
            Toast.fire({
                icon: el.actionAlert,
                title: `<div class="fs-5 text-${el.actionAlert}">${el.textAlert}</div>`,
                html: resultHTML,
                timer: el.timerAlert
            }).then((data) => {
                location.reload();
            });
        }
    });
}
// change status
function status(params) {
    $("body").on('click', '.btn-status', function(e) {
        Swal.fire({
            title: '<span class="text-secondary fs-4"> Cập nhật trạng thái?</span>',
            width: '300',
            icon: 'question',
            confirmButtonText: '<i class="fa-solid fa-check"></i> Tôi đồng ý',
            showCancelButton: true,
            cancelButtonText: '<i class="fa-solid fa-rotate"></i> không',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id');
                let status = $(this).attr('data-status');
                $.post(params + "/status", { id: id, status: status } )
                .done(function(result) {
                    swal_condition(result);
                })
                .fail(function() {
                    swal_condition('error');
                })
            } else {
                swal_condition('cancel');
            }
        });
    });
}
// destroy
function destroy(params) {
    $("body").on('click', '.btn-destroy', function(e) {
        Swal.fire({
            title: '<span class="text-secondary fs-4"> Xóa mục vừa chọn?</span>',
            width: '300',
            icon: 'question',
            confirmButtonText: '<i class="fa-solid fa-check"></i> Tôi đồng ý',
            confirmButtonColor: '#9d2a35',
            showCancelButton: true,
            cancelButtonText: '<i class="fa-solid fa-rotate"></i> không',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                $.post(params + "/destroy", { id: id })
                .done(function(result) {
                    swal_condition(result);
                })
                .fail(function() {
                    swal_condition('error');
                })
            } else {
                swal_condition('cancel');
            }
        });
    });
}
// cancel
function cancel(params) {
    $(".btn-cancel").on('click', function(e) {
        Swal.fire({
            title: '<span class="text-secondary fs-3"> Hệ thống hủy dữ liệu </span>',
            width: '450',
            icon: 'question',
            confirmButtonText: ' <i class="bi bi-trash2"></i> Xác nhận',
            confirmButtonColor: '#d33',
            showCancelButton: true,
            cancelButtonText: '<i class="bi bi-x-lg"></i> Hủy',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id');
                let status = $(this).attr('data-status');
                $.post(params + "/cancel", {
                        id: id,
                        status: status
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            } else {
                swal_condition('cancel');
            }
        });
    });
}

function removeSubFile(params) {
    $('body').on('click','.btn-removeSubFile',function (e) {
        const id = $(this).attr('data-id');
        const idsub = $(this).attr('data-idsub');
        $.post(params + "/removeSubFile", { id: id, idsub: idsub } )
        .done(function(result) {
            swal_condition(result);
        })
        .fail(function() {
            swal_condition('error');
        })
    });
}

function removeSingleFile(params) {
    $('body').on('click','.btn-removeSingleFile',function (e) {
        const id = $(this).attr('data-id');
        $.post(params + "/removeSingleFile", { id: id } )
        .done(function(result) {
            swal_condition(result);
        })
        .fail(function() {
            swal_condition('error');
        })
    });
}
