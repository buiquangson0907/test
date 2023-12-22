<li class="list-cat-item" data-id="{{ $item->id }}">
    <div class="d-flex justify-content-between">
        @if ($item->depth <= 1)
            @if(count($item->children) > 0)
                <span class="text-warning" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $item->id }}">
                    <i class="fa-solid fa-arrows-left-right-to-line"></i> {{ $item->name }}
                </span>
            @else
                <span class="text-secondary">
                    <i class="fa-solid fa-arrows-left-right"></i> {{ $item->name }}
                </span>
            @endif
        @else
            <span class="text-danger" data-bs-toggle="tooltip" title="Thẻ chỉ yêu cầu 2 cấp độ - cao hơn không chấp nhận">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $item->name }} <small>(Thẻ chỉ yêu cầu 2 cấp độ)</small>
            </span>
        @endif
        <div class="d-flex">
            @if ($item->status == 0)
                <div class="btn-destroy text-dark text-decoration-none mx-1 pointer" data-id="{{ $item->id }}" data-bs-toggle="tooltip" title="xoá danh mục">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
            @endif
            <div class="btn-status text-dark text-decoration-none mx-1 pointer" data-id="{{ $item->id }}" data-status="{{ $item->status }}" data-bs-toggle="tooltip" title="cập nhật trạng thái">
                @if ($item->status == 1)
                    <i class="fa-solid fa-toggle-on text-info"></i>
                @else
                    <i class="fa-solid fa-toggle-off"></i>
                @endif
            </div>
            <a data-parent="{{ $item->parent_id }}" data-id="{{ $item->id }}"
                data-bs-toggle="modal" data-bs-target="#saveModal"
                data-toggle="tooltip" title="Sửa"
                class="btn-edit text-dark text-decoration-none mx-1 pointer">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
            </a>
            @if ($item->depth <= 1)
                <a data-parent="{{ $item->id }}"
                    data-bs-toggle="modal" data-bs-target="#saveModal"
                    data-toggle="tooltip" title="Thêm danh mục con"
                    class="btn-edit text-dark text-decoration-none mx-1 pointer">
                    <i class="fa-solid fa-circle-plus"></i>
                </a>
            @endif
        </div>
    </div>

    @if($item->children)
        <ol class="list-cat collapse show" id="panelsStayOpen-collapse{{ $item->id }}">
            @foreach($item->children as $subitem)
                @include('admin.products.group-tag.tree-item', ['item' => $subitem])
            @endforeach
        </ol>
    @endif
</li>

