// token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// popover
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl, {
        trigger: 'hover click',
        html: true,
        placement: 'top'
    });
});
// tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});
var tooltipList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipList.map(function (tooltipEl) {
    return new bootstrap.Tooltip(tooltipEl)
});
// load page effect
$('.get-hash').add('.get-load').on('click',function (e) {
    Swal.fire({
        html: 'Chờ tải dữ liệu sau <b></b> mili giây.',
        timer: 200,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b');
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
            }, 100);
        }
    });
});

$('.singleSelect2').select2({
    theme: 'bootstrap-5',
    allowClear: false
});

/*
    datemask
*/
$('.datemask').inputmask("datetime",{inputFormat: "dd-mm-yyyy",placeholder: "dd-mm-yyyy",separator: "-",alias: "dd-mm-yyyy"});
$('.datemaskslash').inputmask("datetime",{inputFormat: "dd/mm/yyyy",placeholder: "dd/mm/yyyy",separator: "/",alias: "dd/mm/yyyy"});
$('.datemymask').inputmask("datetime",{inputFormat: "mm/yyyy",placeholder: "mm/yyyy",separator: "-",alias: "mm/yyyy"});
$('.dateymask').inputmask("datetime",{inputFormat: "yyyy",placeholder: "yyyy",separator: "-",alias: "yyyy"});
$('.phonemask').inputmask("9999.999.999");
$(".currency_vn").inputmask({'alias': 'currency', allowMinus: false, groupSeparator: ".", digits: 0, rightAlign: false });
$(".numeric").inputmask({ alias: 'numeric',  max: 10000, 'rightAlign': false });
//
$(document).scroll(function(){
    var scroll_pos = $(window).scrollTop();
    if(scroll_pos > 80){
        $('.nutluu').css({"position": "fixed", "right": "30px","top":"70px","z-index":"999"});
    }else{
        $('.nutluu').css({"position": "sticky"});
    }
});

