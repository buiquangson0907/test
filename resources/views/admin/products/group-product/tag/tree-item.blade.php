@if ($item->depth == 0)
    <div class="col-md-4 bg-light">
        <div class="form-check form-switch d-inline-block" data-bs-toggle="tooltip" title="Chọn thẻ đi cùng danh mục sản phẩm">
            <input class="form-check-input check-warning" type="checkbox" name="group_tag_id[]" value="{{ $item->id }}" id="per{{ $item->id }}"
            @if (in_array($item->id, $hasTag)) checked @endif >
            <label class="form-check-label" for="per{{ $item->id }}">
                 {{ $item->name }}
            </label>
        </div>
    </div>
@elseif ($item->depth == 1)
    <span class="badge bg-light text-secondary"><i class="fa-solid fa-tag"></i> {{ $item->name }}</span>
@endif

@if($item->children)
    @foreach($item->children as $subitem)
        @include('admin.products.group-product.tag.tree-item', ['item' => $subitem])
    @endforeach
@endif
