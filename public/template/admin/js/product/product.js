        var popoverMediaAction = [].slice.call(document.querySelectorAll('.removeHasFile'));
        popoverMediaAction.map(function (elPopover) {
            $('body').on('click','.btn-miss',function (e) {
                popover.hide()
            });
            const id = elPopover.dataset.id;
            const idsub = elPopover.dataset.idsub;
            const popover = new bootstrap.Popover(elPopover, {
                trigger: 'hover click',
                html: true,
                sanitize: false,
                container: elPopover,
                title: "Hộp thoại xoá hình ảnh",
            });

            return popover._config.content = fcontent(id,idsub);

        });

        function fcontent(id,idsub) {
            return `<div data-name="popover-test-content">
                    <div class="col-sm-12 input-group-sm">
                        <p>Bạn có chắc xoá file này chứ?</p>
                    </div>
                    <div class="text-center">
                        <button type="button" href="#" class="btn btn-sm btn-outline-danger me-2 btn-miss">không</button>
                        <div data-id="${id}" data-idsub="${idsub}" class="btn btn-sm btn-outline-success ${idsub ? 'btn-removeSubFile' : 'btn-removeSingleFile'}">Chắc chắn</div>
                    </div>
                </div>`;
        }

        removeSubFile('admin/product');
        removeSingleFile('admin/product');

        $('.ajaxvalidate').on('change',function (e) {
           setTimeout(function() {
               var name = $('input:text[name=name]').val();

               $.ajax({
                   url: "admin/product/ajaxValidate",
                   type:'POST',
                   data: { name : name},
                   success: function(result) {
                       $('#invalid-name').empty();
                       if (result.error) {
                           if (!result.error.name) {
                               $('#name').removeClass('is-invalid');
                           } else {
                               $('#invalid-name').append(result.error.name);
                           }
                       } else {
                           $('.ajaxvalidate').removeClass('is-invalid');
                       }
                   }
               });
           }, 1000);
       });

       $('#group_product_id').on('change',function (e) {
           var group_product_id = $(this).val();
           var product_id = $('input[name=product_id]').val();
           $.ajax({
               type: "POST",
               url: "admin/product/ajaxGetTag",
               data: { group_product_id : group_product_id , product_id: product_id},
               success: function (response) {
                    var contentTag = '';

                    if (response.group_tags.length > 0) {
                        response.group_tags.forEach(elContent => {
                            var checkTag = '';
                            if (elContent.children.length > 0) {
                                elContent.children.forEach(elTag => {
                                        var checked = response.arr_checked_tags.includes(elTag.id) ? 'checked' : '';
                                        checkTag +=   `<div class="form-check form-check-inline">
                                            <input class="form-check-input check-warning" type="checkbox" name="tags[]" value="${elTag.id}" id="tag${elTag.id}" ${checked}>
                                            <label class="form-check-label" for="tag${elTag.id}">
                                                ${elTag.name}
                                            </label>
                                        </div>
                                    `;
                                });
                            }
                            contentTag += `
                                <div class="text-primary mt-2"><i class="fa-solid fa-tag"></i> ${elContent.name}</div>
                                ${checkTag}
                            `;
                        });
                    }else{
                        contentTag = `<div class="text-warning">
                        <i class="fa-solid fa-triangle-exclamation"></i> Hệ thống chưa phát hiện dữ liệu phù hợp cho dữ kiện danh mục sản phẩm này!
                    </div>`;
                    }
                    var group_product = '';
                    if (response.group_product) {
                        group_product = `<a href="admin/group-product/tag/${response.group_product.id}"  class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="tooltip" title="Chỉnh sửa lọc sản phẩm cho danh mục này">
                            <i class="fa-solid fa-box-open"></i> ${response.group_product.name}
                        </a>`;
                    }
                    $('#tag').html(group_product + contentTag );
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
       });
