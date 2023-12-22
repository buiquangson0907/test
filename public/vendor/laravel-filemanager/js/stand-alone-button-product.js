(function ($) {

    $.fn.filemanager = function (type, options) {
        type = type || 'file';
        this.on('click', function (e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager-product';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            var height = 800;
            var width = 800;
            var top = (screen.height - height) / 4;
            var left = (screen.width - width) / 2;
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                target_input.val('').val(file_path).trigger('change');

                target_preview.html('');

                items.forEach(function (item) {
                    target_preview.append(
                        $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                    );
                });

                target_preview.trigger('change');
            };
            return false;
        });
    }

})(jQuery);

$('#lfmproduct').filemanager('product');
