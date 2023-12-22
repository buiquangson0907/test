<li class="list-cat-item" data-id="{{ $category->id }}">
    <div class="d-flex justify-content-between">
        <div>
            @if(count($category->children) > 0)
            <span class="text-warning" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $category->id }}">
                <i class="fa-solid fa-arrows-left-right-to-line"></i> {{ $category->name }}
            </span>
            @else
            <span class="text-secondary">
                <i class="fa-solid fa-arrows-left-right"></i> {{ $category->name }}
            </span>
            @endif
        </div>
        <div class="d-flex">
            @if($category->depth == 0)
                <a href="admin/group-product/tag/{{ $category->id }}" data-toggle="tooltip" title="Gắn thẻ kèm danh mục (main)"
                    class="text-decoration-none mx-1 pointer">
                    <i class="fa-solid fa-tags text-warning"></i>
                </a>
            @elseif ($category->depth < 2)
                <a href="admin/group-product/tag/{{ $category->id }}" data-toggle="tooltip" title="Gắn thẻ kèm danh mục (sub)"
                    class="text-decoration-none mx-1 pointer">
                    <i class="fa-solid fa-tag text-dark"></i>
                </a>
            @endif
            @if ($category->status == 0)
                <div class="btn-destroy text-dark text-decoration-none mx-1 pointer" data-id="{{ $category->id }}" data-bs-toggle="tooltip" title="xoá danh mục">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
            @endif
            <div class="btn-status text-dark text-decoration-none mx-1 pointer" data-id="{{ $category->id }}" data-status="{{ $category->status }}" data-bs-toggle="tooltip" title="cập nhật trạng thái">
                @if ($category->status == 1)
                    <i class="fa-solid fa-toggle-on text-info"></i>
                @else
                    <i class="fa-solid fa-toggle-off"></i>
                @endif
            </div>
            <a data-parent="{{ $category->parent_id }}" data-id="{{ $category->id }}"
                data-bs-toggle="modal" data-bs-target="#saveModal"
                data-toggle="tooltip" title="Sửa"
                class="btn-edit text-dark text-decoration-none mx-1 pointer">
                <i class="fa-solid fa-pen-to-square text-primary"></i>
            </a>
            <a data-parent="{{ $category->id }}"
                data-bs-toggle="modal" data-bs-target="#saveModal"
                data-toggle="tooltip" title="Thêm danh mục con"
                class="btn-edit text-dark text-decoration-none mx-1 pointer">
                <i class="fa-solid fa-circle-plus"></i>
            </a>
        </div>
    </div>

    @if($category->children)
        <ol class="list-cat collapse show" id="panelsStayOpen-collapse{{ $category->id }}">
            @foreach($category->children as $subcategory)
                @include('admin.products.group-product.tree-item', ['category' => $subcategory])
            @endforeach
        </ol>
    @endif
</li>

