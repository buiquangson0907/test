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
            @if ($category->status_home == 1)
                <div class="btn-destroy text-danger text-decoration-none mx-1 pointer" data-id="{{ $category->id }}" data-bs-toggle="tooltip"
                    title="<span class='text-info'>Huỷ hiện thị</span>" data-bs-html="true">
                    <i class="fa-regular fa-eye"></i>
                </div>
            @else
                <div class="badge text-dark" data-bs-toggle="tooltip" title="<span class='text-secondary'>Chưa cập nhật hoặc hiển thị</span>" data-bs-html="true">
                    <i class="fa-solid fa-ban"></i>
                </div>
            @endif
            <div class="btn-status text-dark text-decoration-none mx-1 pointer" data-id="{{ $category->id }}" data-status="{{ $category->status_home }}" data-bs-toggle="tooltip" title="cập nhật trạng thái">
                @if ($category->status_home == 1)
                    <i class="fa-solid fa-toggle-on text-info"></i>
                @else
                    <i class="fa-solid fa-toggle-off"></i>
                @endif
            </div>
        </div>
    </div>

    @if($category->children)
        <ol class="list-cat collapse show" id="panelsStayOpen-collapse{{ $category->id }}">
            @foreach($category->children as $subcategory)
                @include('admin.setups.setup-home.tree-item', ['category' => $subcategory])
            @endforeach
        </ol>
    @endif
</li>

