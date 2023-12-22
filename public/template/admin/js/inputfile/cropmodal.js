// crop image
var $uploadCrop, rawImg;
function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#cropImagePop').modal('show');
            rawImg = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function cutimage(w, h) {
    $uploadCrop = $('#image-modal').croppie({
        viewport: {
            width: w,
            height: h,
        },
        enforceBoundary: false,
        enableExif: true
    });
    $('#cropImagePop').on('shown.bs.modal', function () {
        $uploadCrop.croppie('bind', {
            url: rawImg
        });
    });
    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'png',
            size: {
                width: w,
                height: h
            }
        }).then(function (resp) {
            $('#cropImagePop').modal('hide');
            $('.preview').attr('src', resp);
            $('#preview').addClass('d-block');
            $(".hiddenfile").val(resp);
        });
    });

}

$('#dropfileModal').on('change', function () {
    readFile(this);
    let filesCount = $(this)[0].files.length;
    let $textContainer = $(this).prev();
    if (filesCount === 1) {
        let fileName = $(this).val().split('\\').pop();
        $textContainer.text(fileName);

    } else if (filesCount === 0) {
        $textContainer.text('or drop files here');
    } else {
        $textContainer.text(filesCount + ' files selected');
    }
});
// end crop image

// drag input button
$('.dropfile').on('dragenter focus click', function () {
    $('.file-drop-area').addClass('is-active');
});
$('.dropfile').on('dragleave blur drop', function () {
    $('.file-drop-area').removeClass('is-active');
});


$('.item-delete').on('click', function () {
    $('#dropfileModal').val('');
    $('.file-msg').text('or drop files here');
    $('.hiddenfile').val('');
    $('.preview').attr('src','');
    $('#preview').removeClass('d-block');
});
// end drag input button


// input upload button
$('.uploadfile').on('change', function() {
    $('#cancelCropBtn').data('id', $(this).data('id'));
    readFile(this);
});
$('.icon-trash').on('click', function(event) {

    $(".preview").attr("src", `image/logo.png?v=${Date.now()}`);
    $(".hiddenfile").val("");

    event.preventDefault();

});
// end input upload button

