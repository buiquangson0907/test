// Toast Alert
const ToastAlert = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: true,
    confirmButtonText: '<i class="fa-solid fa-rotate"></i> Đóng!',
    timer: 20000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

var arraySession = [
    {
        'idAlert' : 'success', 'actionAlert' : 'success', 'textAlert' : 'Thông báo thành công'
    },
    {
        'idAlert' : 'error', 'actionAlert' : 'error', 'textAlert' : 'Thông báo lỗi'
    },
    {
        'idAlert' : 'warning', 'actionAlert' : 'warning', 'textAlert' : 'Thông báo lỗi xác nhận'
    },
    {
        'idAlert' : 'permission', 'actionAlert' : 'warning', 'textAlert' : 'Quền truy cập'
    },
];
var idAlert = $(".toast-alert").attr('data-id');
var bodyAlert = $(".toast-alert").val();

arraySession.forEach(element => {
    if(idAlert == element.idAlert) {
        ToastAlert.fire({
            icon: element.actionAlert,
            title: `<div class="fs-5 text-${element.actionAlert}">${element.textAlert}</div>`,
            html: bodyAlert,
        });
    }
});
