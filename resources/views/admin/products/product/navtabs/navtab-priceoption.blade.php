<div class="row">
    <div class="col-md-5">
        <div class="mt-3">
            <label for="cost" class="fw-bold"><i class="fa-solid fa-money-bill"></i> Giá gốc</label>
            <div class="input-group">
                <input type="text" name="cost" value="{{ old('cost', $product->cost ? intval($product->cost) : '') }}"
                class="form-control currency_vn" placeholder="nhập giá bán" id="cost">
                <span class="input-group-text">vnđ</span>
            </div>
        </div>
        <div class="mt-3">
            <label for="price" class="fw-bold"><i class="fa-solid fa-money-bill"></i> Giá bán</label>
            <div class="input-group">
                <input type="text" name="price" value="{{ old('price', $product->price ? intval($product->price) : '') }}"
                class="form-control currency_vn" placeholder="nhập giá bán" id="price">
                <span class="input-group-text">vnđ</span>
            </div>
        </div>
        <div class="mt-3">
            <label for="warranty" class="fw-bold"><i class="fa-regular fa-calendar"></i> Bảo hành</label>
            <div class="input-group">
                <input type="text" name="warranty" value="{{ old('warranty', $product->warranty) }}"
                class="form-control numeric" placeholder="nhập số tháng bảo hành" id="warranty">
                <span class="input-group-text"> tháng</span>
            </div>
        </div>
        <div class="mt-3">
            <label for="quantity" class="fw-bold"><i class="fa-solid fa-hashtag"></i> Số lượng trong kho</label>
            <div class="input-group">
                <input type="text" name="quantity" value="{{ old('quantity', $product->quantity) }}" id="quantity" class="form-control numeric" placeholder="Nhập số lượng hàng">
                <span class="input-group-text">cái/chiếc</span>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="mt-3">
            <label class="fw-bold"><i class="fa-solid fa-wand-magic-sparkles"></i> SẢN PHẨM TUỲ CHỌN</label>
            <div id="option_product">
                @if ($options && count($options) > 0)
                    @foreach ($options as $item)
                        <div class="option-item">
                            <div class="input-group input-group-sm mt-1">
                                <span class="input-group-text fw-bold">Tên biến thể</span>
                                <input type="text" name="options[{{ $item->serial_id }}][name]" value="{{ $item->name }}" class="form-control" placeholder="Nhập tên sản phẩm biến thể" required>
                            </div>
                            <div class="input-group input-group-sm mt-1">
                                <span class="input-group-text fw-bold">Giá gốc</span>
                                <input type="text" name="options[{{ $item->serial_id }}][cost]" value="{{ ($item->cost ? intval($item->cost) : '') }}" class="form-control currency_vn" placeholder="Nhập giá gốc tuỳ chọn">
                                <span class="input-group-text">vnđ</span>
                            </div>
                            <div class="input-group input-group-sm mt-1">
                                <span class="input-group-text fw-bold">Giá bán</span>
                                <input type="text" name="options[{{ $item->serial_id }}][price]" value="{{ ($item->price ? intval($item->price) : '') }}" class="form-control currency_vn" placeholder="Nhập giá bán tuỳ chọn">
                                <span class="input-group-text">vnđ</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="option-item">
                        <div class="input-group input-group-sm mt-1">
                            <span class="input-group-text fw-bold">Tên biến thể</span>
                            <input type="text" name="options[0][name]" class="form-control" placeholder="Nhập tên sản phẩm biến thể">
                        </div>
                        <div class="input-group input-group-sm mt-1">
                            <span class="input-group-text fw-bold">Giá gốc</span>
                            <input type="text" name="options[0][cost]" class="form-control currency_vn" placeholder="Nhập giá gốc tuỳ chọn">
                            <span class="input-group-text">vnđ</span>
                        </div>
                        <div class="input-group input-group-sm mt-1">
                            <span class="input-group-text fw-bold">Giá bán</span>
                            <input type="text" name="options[0][price]" class="form-control currency_vn" placeholder="Nhập giá bán tuỳ chọn">
                            <span class="input-group-text">vnđ</span>
                        </div>
                    </div>
                @endif

            </div>
            <div class="float-end mt-1 ">
                <div class="btn btn-sm btn-secondary btn-minus-option" data-bs-toggle="tooltip" title="Xoá sản phẩm tuỳ chọn cuối" >
                    <i class="fa-solid fa-minus"></i>
                </div>
                <div class="btn btn-sm btn-primary btn-add-option" data-bs-toggle="tooltip" title="Thêm sản phẩm">
                    <i class="fa-solid fa-plus"></i>
                </div>
            </div>

        </div>
    </div>
</div>
@push('livecode-css')
@endpush
@push('livecode-js')
    <script src="vendor/jquery-ui/jquery-ui-1.13.2.min.js"></script>
    <script>
        $( "#option_product" ).sortable();
        $('.btn-add-option').on('click', function() {
            var index = $('#option_product .option-item').length;
            var content = `
            <div class="option-item">
                    <div class="input-group input-group-sm mt-1">
                        <span class="input-group-text fw-bold">Tên biến thể</span>
                        <input type="text" name="options[${index}][name]" class="form-control" placeholder="Nhập tên sản phẩm biến thể">
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <span class="input-group-text fw-bold">Giá gốc</span>
                        <input type="text" name="options[${index}][cost]" class="form-control currency_vn" placeholder="Nhập giá gốc tuỳ chọn">
                        <span class="input-group-text">vnđ</span>
                    </div>
                    <div class="input-group input-group-sm mt-1">
                        <span class="input-group-text fw-bold">Giá bán</span>
                        <input type="text" name="options[${index}][price]" class="form-control currency_vn" placeholder="Nhập giá bán tuỳ chọn">
                        <span class="input-group-text">vnđ</span>
                    </div>
                </div>
            `;
            $('#option_product').append(content);
            $(".currency_vn").inputmask({'alias': 'currency', allowMinus: false, groupSeparator: ".", digits: 0, rightAlign: false });
        });

        $('.btn-minus-option').on('click', function() {
            $('#option_product .option-item').last().remove();
        });
    </script>
@endpush
