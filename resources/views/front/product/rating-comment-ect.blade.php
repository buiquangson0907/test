<section class="container wrap-content">
    <div class="col-page-full product-info-start mt-2">
        <h2 class="box-title">
            Video
        </h2>
        <div class="iframe-wrap text-center ">
            @php
                echo html_entity_decode($product->embed_video);
            @endphp
        </div>
    </div>
    <div class="col-page-full product-info-start mt-4">
        <h2 class="box-title">
            Đánh giá, nhận xét sản phẩm
        </h2>
        <div class="box-review">
            <div class="box-review__start">
                <div class="star__title">SAO TRUNG BÌNH</div>
                <div class="star__num">
                    <span>0</span>
                    <span><i class="fa-solid fa-star"></i></p>
                </div>
            </div>
            <div class="box-review__middle">
                <ul class="star__list">
                    @for ($i = 5; $i > 0; $i--)
                        <li class="star__list-item">
                            <span>{{ $i }} <i class="fa-solid fa-star"></i></span>
                            <div class="progress style__progress">
                                <div class="progress-bar style__progress-bar" style="width: 15%;"></div>
                            </div>
                            <span>1 đánh giá</span>
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="box-review__end">
                <div class="dialog-review">
                    Hiện chưa có đánh giá nào.
                </div>
                <div class="btn-show-review" data-bs-toggle="modal" data-bs-target="#globalMember">
                    Đánh giá ngay
                </div>
            </div>

            <div class="box-review__rating d-none">
                <span class="close-rating"><i class="fa-solid fa-minus"></i></span>
                <div class="rating-top">
                    <span class="rating-top__title">
                        Chọn đánh giá của bạn
                    </span>
                    <div class="rating">
                        @for ($i = 5; $i > 0; $i--)
                            <input type="radio" name="rating" id="rating-{{ $i }}">
                            <label for="rating-{{ $i }}"><i class="fa-solid fa-star"></i></label>
                        @endfor
                    </div>
                </div>
                <div class="rating-form">
                    <div class="rating-form__start">
                        <textarea name="" class="form__message" placeholder="* Gửi lời nhắn"></textarea>
                    </div>
                    <div class="rating-form__end">
                        <input type="text" class="form-input" placeholder="* Họ tên">
                        <input type="text" class="form-input" placeholder="* Số điện thoại">
                        <input type="text" class="form-input" placeholder="* Email">
                        <button type="submit" class="form-input form-submit">
                            Gửi đánh giá <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-qa">
            <h4 class="box-title__sub">
                Hỏi và đáp
            </h4>
            <div class="box-qa__comment">
                <div class="comment-form">
                    <div class="comment-form__start">
                        <textarea name="" class="form__message"></textarea>
                    </div>
                    <div class="comment-form__end">
                        <button type="submit" class="form-input form-submit ">
                            <i class="fa-solid fa-paper-plane"></i> Gửi
                        </button>
                    </div>
                </div>
                <div class="comment-list">
                    <div class="comment-item">
                        <div class="cm-item__info">
                            <div class="cm-item__info-start">
                                <div class="btn-icon btn-icon-small box-shadow-none">N</div>
                                <p class="info__name">võ hung nghiem</p>
                            </div>
                            <div class="cm-item__info-end">
                                <i class="fa-solid fa-clock"></i> 5 tháng trước
                            </div>
                        </div>
                        <div class="cm-item__question">
                            <div class="cm-item__question-content">
                                Màn có gần chuẩn màu để dùng làm đồ hoạ được ko shop?
                            </div>
                            <div class="text-end">
                                <a class="btn-reply" href="javascript:void(0)">
                                    <i class="fa-solid fa-comments"></i> Trả lời
                                </a>
                            </div>
                        </div>
                        <div class="comment-item">
                            <div class="cm-item__info">
                                <div class="cm-item__info-start">
                                    <div class="btn-icon btn-icon-small box-shadow-none">N</div>
                                    <p class="info__name">võ hung nghiem</p>
                                    <span class="info__tag">QTV</span>
                                </div>
                                <div class="cm-item__info-end">
                                    <i class="fa-solid fa-clock"></i> 5 tháng trước
                                </div>
                            </div>
                            <div class="cm-item__question">
                                <div class="cm-item__question-content">
                                    Màn có gần chuẩn màu để dùng làm đồ hoạ được ko shop?
                                </div>
                                <div class="text-end">
                                    <a class="btn-reply" href="javascript:void(0)">
                                        <i class="fa-solid fa-comments"></i> Trả lời
                                    </a>
                                </div>
                            </div>
                            <div class="comment-item">
                                <div class="cm-item__info">
                                    <div class="cm-item__info-start">
                                        <div class="btn-icon btn-icon-small box-shadow-none">N</div>
                                        <p class="info__name">võ hung nghiem</p>
                                    </div>
                                    <div class="cm-item__info-end">
                                        <i class="fa-solid fa-clock"></i> 5 tháng trước
                                    </div>
                                </div>
                                <div class="cm-item__question">
                                    <div class="cm-item__question-content">
                                        Màn có gần chuẩn màu để dùng làm đồ hoạ được ko shop?
                                    </div>
                                    <div class="text-end">
                                        <a class="btn-reply" href="javascript:void(0)">
                                            <i class="fa-solid fa-comments"></i> Trả lời
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('livecode-js')
    <script>
        $('body').on('click','#js-btn-rating',function (e) {
            $('.box-review__rating').removeClass('d-none');
            $('#globalMember').modal('hide');
        });
        $('.close-rating').click(function (e) {
            $('.box-review__rating').toggleClass('d-none');
        });
    </script>
@endpush
