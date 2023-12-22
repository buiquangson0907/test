@foreach ($menu_products as $item)
    @php
        $group_product = $item['groupproducts'];
        $group_product_children = $item['groupproducts']->children;
        $products = $item['products'];
    @endphp
    @if (count($products) > 0)
        <div class="home-product-cat">
            <div class="box-title-group">
                <h2 class="cat-title"> <i class="fa-solid fa-minus"></i> {{ $group_product->name }} </h2>
                <div class="cat-list-right">
                    @if (count($group_product_children) > 0)
                        @foreach ($group_product_children as $item)
                            <a href="{{ $item->slug }}" class="shine shine-anim">
                                {{ $item->name }}
                            </a>
                        @endforeach
                    @endif

                    <a href="{{ $group_product->slug }}" class="shine shine-anim">
                        Xem thêm <i class="fa fa-angle-double-right"></i>
                    </a>
                </div>
            </div>
            <div class="home-product-slider">
                @foreach ($products as $item)
                    <div class="product-item" data-id="{{ $item->id }}">
                        <div class="product-item__wrap">
                            <span class="p-discount" data-label="giảm nhiều "></span>
                            <a href="{{ $item->slug }}" class="p-img">
                                @if (File::exists('storage/' . $item->image) && $item->image != null)
                                    <img  data-lazy="{{ 'storage/'.$item->image }}?v={{ time() }}" alt="{{ $item->name }}">
                                @endif
                            </a>
                            <div class="p-text">
                                <div class="p-star-group">
                                    <div class="p-star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </div>
                                    <div class="p-sku"> Mã SP: <span>{{ $item->code ? $item->code : 0 }}</span> </div>
                                </div>

                                <a href="{{ $item->slug }}" class="p-name"> {{ $item->name }} </a>
                                <div class="price-group">
                                    <span class="p-price">{{ number_format($item->price,0,",",".") }}đ</span>
                                    <del>{{ number_format($item->cost,0,',','.') }}đ</del>
                                </div>

                                <div class="p-button">
                                    @if ($item->quantity > 0)
                                        <span class="stocking">
                                            <i class="fa fa-check"></i> Còn hàng
                                        </span>
                                    @else
                                        <span class="out-of-stocking">
                                            Liên hệ
                                        </span>
                                    @endif
                                    <a href="javascript:void(0)" class="p-buy">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-tooltip">

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endforeach


