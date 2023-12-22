<div class="row">
    <div class="col-md-4">
        <div class="mt-3">
            <label class="fw-bold"><i class="fa-regular fa-image"></i> Hình đại diện</label>
            {!! FileDrop::fileDropArea('filesingle', 'fileSingleInput', null) !!}
            <div id="fileSingleList" class="fileList">
                {!! FileDrop::show($product->image, $product->id) !!}
            </div>
        </div>
        <div class="mt-3">
            <label class="fw-bold"><i class="fa-solid fa-images"></i> Thư viện ảnh</label>
            {!! FileDrop::fileDropArea('filemultiple[]', 'fileMultipleInput', 'multiple') !!}
            <div id="fileMultipleList" class="fileList">
                @if ($galleries)
                    @foreach ($galleries as $item)
                        <div class="wrap-item">
                            <div class="image-item">
                                <img src="{{ url('storage/' . $item->name . '?v=' . time()) }}" class="preview"
                                    alt="">
                            </div>
                            <div class="left-item">
                                <p class="title-file">{{ $item->name }}</p>
                                <small>
                                    @if (File::exists('storage/' . $item->name))
                                        {{ vhn_formatSizeUnits(File::size('storage/' . $item->name)) }}
                                    @endif
                                </small>
                                <span class="remove-file removeHasFile" data-id="{{ $item->product_id }}"
                                    data-idsub="{{ $item->serial_id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="mt-3">
            <label class="fw-bold">Quản lý file</label>
            <div id="lfmproduct" class="pointer d-inline-block">
                <i class="fa-solid fa-photo-film fs-3"></i>
            </div>
        </div>
        <div class="mt-3">
            <label class="fw-bold"><i class="fa-brands fa-youtube"></i> video review sản phẩm</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                <input type="text" name="review_video" value="{{ old('review_video',$product->review_video) }}" class="form-control" placeholder="https://www.youtube.com/watch?v=">
              </div>
        </div>
        <div class="mt-3">
            <label for="embed_video" class="fw-bold" data-bs-toggle="popover"
                title="hướng dẫn copy đường dẫn video" data-bs-html="true"
                data-bs-content="vào đường dẫn video trong youtube hoặc nền tảng khác -> share -> embed -> chép iframe -> sau đó dán vào khung nhập -> lưu sản phẩm"
            >
                <i class="fa-brands fa-youtube"></i> video thông số kỹ thuật
            </label>
            <textarea class="editor-200" name="embed_video" id="embed_video">
                {!! old('embed_video',$product->embed_video) !!}
            </textarea>
        </div>
    </div>
    <div class="col-md-8">
        <div class="mt-3">
            <label for="summary" class="fw-bold">
                <i class="fa-solid fa-list-check"></i> Mô tả ngắn sản phẩm
            </label>
            <textarea class="editor-200" name="summary" id="summary">
                {!! $product->summary !!}
            </textarea>
        </div>
        <div class="mt-3">
            <label for="offer" class="fw-bold">
                <i class="fa-solid fa-gift"></i> Quà tặng và Ưu đãi
            </label>
            <textarea class="editor-200" name="offer" id="offer">{!! $product->offer !!}</textarea>
        </div>
        <div class="mt-3">
            <label for="specifications" class="fw-bold">
                <i class="fa-solid fa-microchip"></i> Thông số kỹ thuật
            </label>
            <textarea class="editor-400" name="specifications" id="specifications">{!! $product->specifications !!}</textarea>
        </div>

    </div>
</div>
