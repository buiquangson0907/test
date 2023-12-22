<div class="row">
    <div class="col-md-6">
        <div class="mt-1">
            <label for="name" class="fw-bold">
                Tên sản phẩm (*) <small class="text-danger"></small>
            </label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" id="name"
                class="form-control ajaxvalidate" placeholder="Nhập tên sản phẩm">
            <small class="text-danger" id="invalid-name"> @error('name')
                    {{ $message }}
                @enderror </small>
        </div>
        @if ($product->slug)
            <div class="mt-3">
                <label for="name" class="fw-bold"> Đường dẫn (*) </label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" id="slug"
                    class="form-control" placeholder="Nhập tên dường dẫn">
            </div>
        @endif
        <div class="mt-3">
            <label for="code" class="fw-bold">Mã sản phẩm</label>
            <input type="text" name="code" value="{{ $product->code }}" id="code" class="form-control"
                placeholder="Nhập mã sản phẩm">
        </div>
        <div class="mt-3">
            <label for="meta_title" class="fw-bold">Meta title</label>
            <textarea name="meta_title" class="form-control" id="meta_title" rows="3"
                placeholder="Nhập tiêu đề cho bộ máy tìm kiếm internet">{!! old('meta_title', $product->meta_title) !!}</textarea>
        </div>
        <div class="mt-3">
            <label for="meta_keyword" class="fw-bold">Meta keyword </label> <span class="text-secondary">(cách nhau bằng
                dấu phẩy ',')</span>
            <textarea name="meta_keyword" class="form-control" id="meta_keyword" rows="3"
                placeholder="Nhập từ khoá tìm kiếm trên internet">{!! old('meta_keyword', $product->meta_keyword) !!}</textarea>
        </div>
        <div class="mt-3">
            <label for="meta_description" class="fw-bold">Meta description</label>
            <textarea name="meta_description" class="form-control" id="meta_description" rows="3"
                placeholder="Nhập mô tả cho bộ máy tìm kiếm internet">{!! old('meta_description', $product->meta_description) !!}</textarea>
        </div>
        <div class="mt-3">
            <div class="form-check ps-0">
                <label class="fw-bold"><i class="fa-solid fa-flag-checkered"></i> Hiển thị</label>
                <input id="status" name="status" class="form-check-input" type="checkbox" data-width="70"
                    data-toggle="toggle" data-size="sm" data-on="Hiện" data-off="Ẩn" data-onstyle="primary"
                    data-offstyle="secondary" checked>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="wrap-tag">
            <div class="mt-3">
                <label for="group_product_id" class="fw-bold">
                    <i class="fa-solid fa-list"></i> Danh mục sản phẩm (*)
                </label>
                <select class="form-select singleSelect2" name="group_product_id" id="group_product_id">
                    <option selected="selected" value="">ROOT CATEGOTY</option>
                    {{ VHNMenu::showSelectCat($groupproducts, $product->group_product_id) }}
                </select>
            </div>
            <div class="mt-3">
                <label class="fw-bold">
                    <i class="fa-solid fa-filter"></i> Bộ lọc sản phẩm
                </label>
                <div id="tag">
                    @if ($product->group_product_id)
                        <a href="admin/group-product/tag/{{ $product->group_product_id }}" class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="tooltip" title="Chỉnh sửa lọc sản phẩm cho danh mục này">
                            <i class="fa-solid fa-box-open"></i> {{ $product->group_product_name }}
                        </a>
                    @endif
                    @if ($group_tags)
                        @foreach ($group_tags as $group_tag)
                            <div class="text-primary mt-2"><i class="fa-solid fa-tag"></i> {{ $group_tag->name }}</div>
                            @if ($group_tag->children)
                                @foreach ($group_tag->children as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input check-warning" type="checkbox" name="tags[]"
                                            value="{{ $item->id }}" id="tag{{ $item->id }}"
                                            @if (in_array($item->id, $arr_checked_tags)) checked @endif>
                                        <label class="form-check-label" for="tag{{ $item->id }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <div class="text-warning">
                            <i class="fa-solid fa-triangle-exclamation"></i> Hệ thống chưa phát hiện dữ liệu phù hợp cho dữ kiện danh mục sản phẩm này!
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
