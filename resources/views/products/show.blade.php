@extends('layout')

@section('title', 'Product Details')

@section('content')
    <style>
        /* Custom Star CSS */
        .star-icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            position: relative;
            cursor: pointer;
            margin-right: 5px;
        }

        .star-icon::before {
            content: "★";
            font-size: 24px;
            color: #ccc;
            /* Màu sao không được chọn */
            transition: all 0.2s ease;
        }

        .star-icon.active::before,
        .star-icon:hover::before {
            color: #ffc107;
            /* Màu sao được chọn/hover */
            text-shadow: 0 0 5px rgba(255, 193, 7, 0.5);
        }

        /* Optional: Hiệu ứng khi hover */
        .cr-t-review-rating:hover .star-icon::before {
            transform: scale(1.1);
        }
    </style>
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Product</h2>
                            <span> <a href="index.html">Home</a> - product</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="section-product padding-t-100">
        <div class="container">
            <div class="row mb-minus-24" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                <div class="col-xxl-4 col-xl-5 col-md-6 col-12 mb-24">
                    <div class="vehicle-detail-banner banner-content clearfix">
                        <div class="banner-slider">
                            <div class="slider slider-for">
                                <div class="slider-banner-image">
                                    <div class="zoom-image-hover">
                                        @if ($product->image)
                                            @if (filter_var($product->image, FILTER_VALIDATE_URL))
                                                <img src="{{ $product->image }}" alt="product-tab-1" class="product-image">
                                            @else
                                                <img src="{{ Storage::URL($product->image) }}" alt="product-tab-1"
                                                    class="product-image">
                                            @endif
                                        @else
                                            <div id="mainImage" class="invoice-item-img" data-original-src="">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="slider slider-nav thumb-image">
                                @foreach ($product->images as $image)
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{{ Storage::URL($image->image_path) }}" alt="product-tab-1">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-7 col-md-6 col-12 mb-24">
                    <div class="cr-size-and-weight-contain">
                        <h2 class="heading">{{ $product->name }}</h2>
                        <p>{{ $product->short_description }}</p>
                    </div>
                    <div class="cr-size-and-weight">
                        <div class="cr-review-star">
                            <div class="cr-star">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>( 75 Review )</p>
                        </div>
                        <div class="list">
                            <ul>
                                <li><label>Category <span>:</span></label>{{ $product->category->name }}</li>
                                <li><label>Sold <span>:</span></label>{{ $product->sold_count }}</li>
                                <li><label>In Stock <span>:</span></label>{{ $product->quantity }}</li>
                            </ul>
                        </div>
                        <div class="cr-product-price">
                            <span class="new-price">${{ $product->price }}</span>
                            @if (!empty($product->sale_price))
                                <span class="old-price">${{ $product->sale_price }}</span>
                            @endif
                        </div>

                        <div class="cr-add-card">
                            <div class="cr-qty-main" data-id="{{ $product->id }}">
                                <input type="number" value="1" min="1" class="quantity" style="width: 60px;">
                                <button type="button" class="plus">+</button>
                                <button type="button" class="minus">-</button>
                            </div>
                            <div class="cr-add-button">
                                <button type="button" class="cr-button add-to-cart" data-id="{{ $product->id }}">
                                    Add to cart
                                </button>
                            </div>
                            <div class="cr-card-icon">
                                <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview" role="button">
                                    <i class="ri-eye-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-aos="fade-up" data-aos-duration="400" data-aos-delay="200">
                <div class="col-12">
                    <div class="cr-paking-delivery">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="true">Description</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <div class="cr-tab-content">
                                    <div class="cr-description" style="text-align: justify">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                <div class="col-12">
                    <div class="cr-paking-delivery">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    type="" role="tab" aria-controls="review"
                                    aria-selected="false">Comment</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="review" role="tabpanel"
                                aria-labelledby="review-tab">
                                <div class="cr-tab-content-from">
                                    <div class="post">
                                        <div id="comment-list">
                                            @foreach ($comments as $comment)
                                                <div class="content mt-30">
                                                    <div class="details">
                                                        <span class="date">{{ $comment->created_at }}</span>
                                                        <span class="name">{{ $comment->user->name }}</span>
                                                    </div>
                                                    <div class="cr-t-review-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $comment->rating)
                                                                <i class="ri-star-s-fill"></i>
                                                            @else
                                                                <i class="ri-star-s-line"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>

                                        <div>
                                            {{ $comments->links() }}
                                        </div>
                                    </div>

                                    <div id="comment-form"></div>
                                    @if (Auth::check() && Auth::user()->role == 'user' && $canReview && isset($validOrderId))
                                        <h4 class="heading">Add a Review</h4>
                                        <form
                                            action="{{ route('product.comment.store', [
                                                'user' => auth()->id(),
                                                'product' => $product->id,
                                            ]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="cr-ratting-star">
                                                <span>Your rating :
                                                    <div class="cr-t-review-rating">
                                                        <i class="star-icon" data-rating="1"></i>
                                                        <i class="star-icon" data-rating="2"></i>
                                                        <i class="star-icon" data-rating="3"></i>
                                                        <i class="star-icon" data-rating="4"></i>
                                                        <i class="star-icon" data-rating="5"></i>
                                                        <input type="hidden" name="rating" id="rating-value">
                                                    </div>
                                                    @error('rating')
                                                        <div class="text-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="cr-ratting-input">
                                                <input name="user_id" type="hidden" value="{{ auth()->id() }}">
                                            </div>
                                            <div class="cr-ratting-input">
                                                <input name="product_id" type="hidden"
                                                    value="{{ $product->id ?? '' }}">
                                            </div>
                                            <div class="cr-ratting-input">
                                                <input type="hidden" name="order_id" value="{{ $validOrderId }}">
                                            </div>


                                            <div class="cr-ratting-input">
                                                <textarea name="content" placeholder="Enter Your Comment" class="cr-ratting-input"></textarea>
                                            </div>
                                            @error('content')
                                                <div class="cr-ratting-star">
                                                    <span>
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    </span>
                                                </div>
                                            @enderror
                                            <div class="cr-ratting-input form-submit">
                                                <button class="cr-button" type="submit" value="Submit">Submit</button>
                                            </div>
                                        </form>
                                    @elseif (!Auth::check() || Auth::user()->role != 'user')
                                        <a href="{{ route('login') }}">
                                            <div class="bg-white p-4 rounded shadow-sm">
                                                <h4 class="heading">You must be logged in to add a review</h4>
                                                <p>Please login to add a review.</p>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <script script>
            alert('{{ session('success') }}');
        </script>
    @endif

    @if (session('error_message'))
        <script script>
            alert('{{ session('error_message') }}');;
        </script>
    @endif

    <!-- Popular products -->
    <section class="section-popular-products padding-tb-100" data-aos="fade-up" data-aos-duration="800"
        data-aos-delay="400">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>Similar Products</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et viverra maecenas accumsan lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-popular-product">

                        @foreach ($bestsellers as $product)
                            <div class="slick-slide">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            @if ($product->image)
                                                @if (filter_var($product->image, FILTER_VALIDATE_URL))
                                                    <img src="{{ $product->image }}" alt="product-tab-1"
                                                        class="product-image">
                                                @else
                                                    <img src="{{ Storage::URL($product->image) }}" alt="product-tab-1"
                                                        class="product-image">
                                                @endif
                                            @else
                                                <div id="mainImage" class="invoice-item-img" data-original-src="">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cr-side-view">
                                            <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                                role="button">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </div>
                                        <a class="cr-shopping-bag" href="javascript:void(0)">
                                            <i class="ri-shopping-bag-line"></i>
                                        </a>
                                    </div>
                                    <div class="cr-product-details">
                                        <div class="cr-brand">
                                            <a href="">{{ $product->category->name }}</a>
                                            <div class="cr-star">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                                <p>(4.5)</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="title">{{ $product->name }}</a>
                                        <p class="cr-price"><span class="new-price">${{ $product->price }}</span>
                                            @if (!empty($product->sale_price))
                                                <span class="old-price">${{ $product->sale_price }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Model -->
    <div class="modal fade quickview-modal" id="quickview" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered cr-modal-dialog">
            <div class="modal-content">
                <button type="button" class="cr-close-model btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="zoom-image-hover modal-border-image">
                                <img src="{{ asset('assets/img/product/tab-1.jpg') }}" alt="product-tab-2"
                                    class="product-image">
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="cr-size-and-weight-contain">
                                <h2 class="heading">Peach Seeds Of Change Oraganic Quinoa, Brown product</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1900s,</p>
                            </div>
                            <div class="cr-size-and-weight">
                                <div class="cr-review-star">
                                    <div class="cr-star">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                    </div>
                                    <p>( 75 Review )</p>
                                </div>
                                <div class="cr-product-price">
                                    <span class="new-price">$120.25</span>
                                    <span class="old-price">$123.25</span>
                                </div>
                                <div class="cr-size-weight">
                                    <h5><span>Size</span>/<span>Weight</span> :</h5>
                                    <div class="cr-kg">
                                        <ul>
                                            <li class="active-color">500gm</li>
                                            <li>1kg</li>
                                            <li>2kg</li>
                                            <li>5kg</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cr-add-card">
                                    <div class="cr-qty-main">
                                        <input type="text" placeholder="." value="1" minlength="1"
                                            maxlength="20" class="quantity">
                                        <button type="button" id="add_model" class="plus">+</button>
                                        <button type="button" id="sub_model" class="minus">-</button>
                                    </div>
                                    <div class="cr-add-button">
                                        <button type="button" class="cr-button cr-shopping-bag">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log('jQuery loaded');

            // Hàm xử lý thêm sản phẩm vào giỏ
            function addToCart(productId, button) {
                var quantity = $(button).closest('.cr-add-card').find('.quantity').val();
                quantity = parseInt(quantity) || 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log('Add Response:', res);
                        if (res.success) {
                            $("#cart-grand-total").text("$" + numberFormat(res.cart_total));
                            alert(res.message);
                        } else {
                            alert(res.message || 'Không thể thêm sản phẩm vào giỏ hàng!');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);
                        try {
                            var res = JSON.parse(xhr.responseText);
                            alert(res.message ||
                                'Đã xảy ra lỗi khi thêm sản phẩm!');
                            // window.location.href = '{{ route('login') }}';
                        } catch (e) {
                            alert('Đã xảy ra lỗi khi thêm sản phẩm!');
                        }
                    }
                });
            }

            // Hàm xử lý cập nhật giỏ hàng (dành cho trang giỏ hàng)
            function updateCart(cartId, quantity) {
                if (!cartId) {
                    console.error('Cart ID is undefined');
                    alert('Không thể cập nhật giỏ hàng: Thiếu ID sản phẩm.');
                    return;
                }

                $.ajax({
                    url: '/cart/update',
                    type: 'POST',
                    data: {
                        id: cartId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log('Update Response:', res);
                        var priceElement = $("#total-cart-price-" + cartId)
                            .closest('tr')
                            .find('.cr-cart-price .amount');
                        priceElement.text("$" + numberFormat(res.unit_price));
                        $("#total-cart-price-" + cartId).text("$" + numberFormat(res.total_price));
                        $("#cart-grand-total").text("$" + numberFormat(res.cart_total));
                    },
                    error: function(xhr, status, error) {
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);
                        alert('Lỗi khi cập nhật giỏ hàng: ' + (xhr.responseText || error));
                    }
                });
            }

            // Hàm xử lý xóa sản phẩm
            function deleteCartItem(event, itemId, button) {
                event.preventDefault();

                if (!confirm('You want to remove this product from your cart?')) {
                    return;
                }

                $.ajax({
                    url: "{{ url('/cart') }}/" + itemId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log('Delete Response:', res);
                        if (res.success) {
                            $(button).closest('tr').remove();
                            $("#cart-grand-total").text("$" + numberFormat(res.cart_total));
                            alert('Product removed successfully!');
                        } else {
                            alert('Có lỗi xảy ra: ' + (res.message || 'Không thể xóa sản phẩm'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                        alert('Đã xảy ra lỗi khi xóa sản phẩm!');
                    }
                });
            }

            $(".cart-qty-plus-minus .plus").off('click').on('click', function() {
                var parent = $(this).closest(".cart-qty-plus-minus");
                var input = parent.find(".quantity");
                var cartId = parent.data("id");
                var currentVal = parseInt(input.val()) || 1;

                currentVal += 1;
                input.val(currentVal);
                updateCart(cartId, currentVal);
            });

            $(".cart-qty-plus-minus .minus").off('click').on('click', function() {
                var parent = $(this).closest(".cart-qty-plus-minus");
                var input = parent.find(".quantity");
                var cartId = parent.data("id");
                var currentVal = parseInt(input.val()) || 1;

                if (currentVal > 1) {
                    currentVal -= 1;
                    input.val(currentVal);
                    updateCart(cartId, currentVal);
                }
            });

            // Xử lý khi nhập trực tiếp vào input trong giỏ hàng
            let timeout;
            $(".cart-qty-plus-minus .quantity").on('input', function() {
                clearTimeout(timeout);
                var parent = $(this).closest(".cart-qty-plus-minus");
                var input = $(this);
                var cartId = parent.data("id");
                var newVal = parseInt(input.val()) || 1;

                if (newVal < 1) newVal = 1;
                input.val(newVal);
                timeout = setTimeout(function() {
                    updateCart(cartId, newVal);
                }, 500);
            });
            //Xử lý nút + và - trong trang chi tiết sản phẩm 

            $('.cr-qty-main .plus').off('click').on('click',
                function() {
                    var
                        input = $(this).siblings('.quantity');
                    var currentVal = parseInt(input.val()) || 1;
                    input.val(currentVal + 1);
                });
            $('.cr-qty-main .minus').off('click').on('click', function() {
                var input = $(this).siblings('.quantity');
                var
                    currentVal = parseInt(input.val()) || 1;
                if (currentVal > 1) {
                    input.val(currentVal - 1);
                }
            });

            // Hàm định dạng số
            function numberFormat(number) {
                if (number === undefined || number === null || isNaN(Number(number))) {
                    return "0.00";
                }
                let formattedNumber = Number(number).toFixed(2);
                let [integerPart, decimalPart] = formattedNumber.split('.');
                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return `${integerPart}.${decimalPart}`;
            }

            // Gán sự kiện xóa
            $(document).on('click', '.delete-cart-item', function(event) {
                var itemId = $(this).data('id');
                deleteCartItem(event, itemId, this);
            });

            // Gán sự kiện thêm vào giỏ
            $(document).on('click', '.add-to-cart', function() {
                var productId = $(this).data('id');
                addToCart(productId, this);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-icon');
            const ratingInput = document.getElementById('rating-value');
            let currentRating = 0;

            // Xử lý click
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    currentRating = parseInt(this.getAttribute('data-rating'));
                    ratingInput.value = currentRating;
                    console.log(currentRating);
                    updateStars();
                });
            });

            function updateStars() {
                stars.forEach((s, index) => {
                    s.classList.toggle('active', index < currentRating);
                });
            }
            const hash = window.location.hash;
            if (hash ===
                '#review-tab') {
                const reviewTab = document.querySelector('button[data-bs-target="#review" ]');
                if (reviewTab) { // Sử dụng Bootstrap tab API để kích hoạt 
                    const tab = new bootstrap.Tab(reviewTab);
                    tab.show();
                }
            }
        });
    </script>
@endsection
