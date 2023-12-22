var editor200 = {
    selector: 'textarea.editor-200',
    language : 'vi',
    height: 200,
    menubar: false,
    relative_urls: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar:
        'blocks | bold italic forecolor' +
        ' | bullist numlist | removeformat code',
}
var editor400 = {
    selector: 'textarea.editor-400',
    language : 'vi',
    height: 400,
    menubar: false,
    relative_urls: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: ' blocks | ' +
        'bold italic forecolor | alignleft aligncenter alignright alignjustify | ' +
        ' bullist numlist |' +
        'table | undo redo',
}
var editorArticle = {
    path_absolute: "/",
    selector: 'textarea.editor-article',
    language : 'vi',
    height: 600,
    menubar: true,
    relative_urls: false,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize fontsizeinput| ' +
        'bold italic forecolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'image link media | '+
        'removeformat | table | code fullscreen help',
    font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt 48pt',
    file_picker_callback: function (callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editorArticle.path_absolute + 'filemanager-product?editor=' + meta.fieldname;
        cmsURL = cmsURL + "&type=article";
        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Quản lý bài viết',
            width: x * 0.6,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

tinymce.init(editor200);
tinymce.init(editor400);

tinymce.init(editorArticle);
