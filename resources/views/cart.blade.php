@extends('layout')

@section('title', 'Cart')
@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Cart</h2>
                            <span> <a href="index.html">Home</a> / Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart -->
    <section class="section-cart padding-t-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Cart</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="cr-cart-content" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="row">
                            <form action="" id=orderForm>
                                <div class="cr-table-content">
                                    @if ($carts && count($carts) > 0)
                                        <table>
                                            <thead>
                                                <th>Product</th>
                                                <th>In Stock</th>
                                                <th>Unit price</th>
                                                <th class="text-center">Quantity</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($carts as $item)
                                                    <tr>
                                                        <td class="cr-cart-name">
                                                            <a href="{{ route('product.show', $item->product->id) }}">
                                                                <img src="assets/img/product/1.jpg" alt="product-1"
                                                                    class="cr-cart-img">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </td>
                                                        <td class="cr-cart-stock">
                                                            <span class="text">{{ $item->product->quantity }}</span>
                                                        </td>
                                                        <td class="cr-cart-price">
                                                            <span
                                                                class="amount">${{ number_format($item['price'], 2, ',', '.') }}</span>
                                                        </td>
                                                        <td class="cr-cart-qty">
                                                            <div class="cart-qty-plus-minus" data-id="{{ $item->id }}">
                                                                <button type="button" class="minus">-</button>
                                                                <input type="text" class="quantity"
                                                                    value="{{ $item->quantity }}"
                                                                    data-max={{ $item->product->quantity }} />
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                            <span class="error-message"
                                                                style="color: red; display: block; font-size: 12px; margin-top: 5px;"></span>
                                                        </td>
                                                        <td class="cr-cart-subtotal"
                                                            id="total-cart-price-{{ $item->id }}">
                                                            ${{ number_format($item->total_price, 2, ',', '.') }}
                                                        </td>

                                                        <td class="cr-cart-remove">
                                                            <button class="btn btn-danger btn-sm delete-cart-item"
                                                                data-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <style>
                                            .cart-total-box {
                                                margin-top: 10px;
                                                background-color: rgba(17, 122, 101, 0.65);
                                                /* màu #117a65 với độ mờ 85% */
                                                /* xanh ngọc (teal) */
                                                color: white;
                                                padding: 15px 20px;
                                                border-radius: 8px;
                                                text-align: right;
                                                font-weight: bold;
                                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                            }
                                        </style>
                                        <h4 class="cart-total-box">
                                            CART TOTAL:
                                            <span id="cart-grand-total">
                                                ${{ number_format($totalPrice, 2, ',', '.') }}
                                            </span>
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="cr-cart-update-bottom">
                                                    <a href="{{ route('products') }}" class="cr-links">Continue
                                                        Shopping</a>
                                                    <a href="{{ route('checkout') }}" class="cr-button">
                                                        Check Out
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p>Your cart is empty now.</p>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="cr-cart-update-bottom">
                                                    <a href="{{ route('products') }}" class="cr-button">Go to shopping</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular products -->
    <section class="section-popular-products padding-tb-100" data-aos="fade-up" data-aos-duration="2000"
        data-aos-delay="400">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>Popular Products</h2>
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
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="assets/img/product/9.jpg" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
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
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                        mix pack 200gm</a>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="assets/img/product/10.jpg" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
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
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Sweet snakes crunchy nut
                                        mix 250gm
                                        pack</a>
                                    <p class="cr-price"><span class="new-price">$100.00</span> <span
                                            class="old-price">$110.00</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="assets/img/product/1.jpg" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
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
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                        mix pack 200gm</a>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="assets/img/product/2.jpg" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
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
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Sweet snakes crunchy nut
                                        mix 250gm
                                        pack</a>
                                    <p class="cr-price"><span class="new-price">$100.00</span> <span
                                            class="old-price">$110.00</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="slick-slide">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="assets/img/product/3.jpg" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
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
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Sweet snakes crunchy nut
                                        mix 250gm
                                        pack</a>
                                    <p class="cr-price"><span class="new-price">$100.00</span> <span
                                            class="old-price">$110.00</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            console.log('jQuery loaded');

            // Hàm xử lý cập nhật giỏ hàng
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
                        if (res.success === false) {
                            alert(res.message || 'Không thể cập nhật giỏ hàng!');
                            return;
                        }
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
                        try {
                            var res = JSON.parse(xhr.responseText);
                            alert(res.message || res.error || 'Lỗi khi cập nhật giỏ hàng!');
                        } catch (e) {
                            alert('Lỗi khi cập nhật giỏ hàng: ' + (xhr.responseText || error));
                        }
                    }
                });
            }

            // Hàm xử lý xóa sản phẩm
            function deleteCartItem(event, itemId, button) {
                event.preventDefault();

                if (!confirm('Remove this product?')) {
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

                            // Kiểm tra nếu giỏ hàng trống thì reload trang
                            if ($('tbody tr').length === 0) {
                                location.reload();
                            }
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

            // Xử lý nút + và -
            $(".plus, .minus").off('click').on('click', function() {
                console.log('Button clicked');
                var parent = $(this).closest(".cart-qty-plus-minus");
                var input = parent.find(".quantity");
                var cartId = parent.data("id");
                var currentVal = parseInt(input.val()) || 1;
                var max = parseInt(input.data('max'));
                var errorMessage = parent.find('.error-message');

                if ($(this).hasClass("plus")) {
                    currentVal += 1;
                    if (currentVal > max) {
                        errorMessage.text(`Chỉ còn ${max} sản phẩm trong kho!`).show();
                        return; // Không thay đổi giá trị, không gọi updateCart
                    } else {
                        errorMessage.hide();
                    }
                } else if ($(this).hasClass("minus") && currentVal > 1) {
                    currentVal -= 1;
                    errorMessage.hide();
                }

                input.val(currentVal);
                updateCart(cartId, currentVal);
            });

            // Xử lý khi nhập trực tiếp vào input
            let timeout;
            $(".quantity").on('input', function() {
                clearTimeout(timeout);
                var parent = $(this).closest(".cart-qty-plus-minus");
                var cartId = parent.data("id");
                var newVal = parseInt($(this).val()) || 1;
                var max = parseInt($(this).data('max'));
                var errorMessage = parent.find('.error-message');

                if (newVal < 1) {
                    newVal = 1;
                    errorMessage.hide();
                } else if (newVal > max) {
                    errorMessage.text(`Chỉ còn ${max} sản phẩm trong kho!`).show();
                    // Không giới hạn về max, giữ nguyên giá trị người dùng nhập
                } else {
                    errorMessage.hide();
                }

                $(this).val(newVal);

                timeout = setTimeout(function() {
                    if (newVal <= max) { // Chỉ cập nhật nếu hợp lệ
                        updateCart(cartId, newVal);
                    }
                }, 500);
            });

            // Kiểm tra trước khi gửi form
            $('#orderForm').on('submit', function(e) {
                var hasError = false;
                $('.quantity').each(function() {
                    var max = parseInt($(this).data('max'));
                    var value = parseInt($(this).val());
                    var errorMessage = $(this).siblings('.error-message');

                    if (value > max) {
                        errorMessage.text(`Chỉ còn ${max} sản phẩm trong kho!`).show();
                        hasError = true;
                    } else {
                        errorMessage.hide();
                    }
                });

                if (hasError) {
                    e.preventDefault();
                    alert('Vui lòng điều chỉnh số lượng sản phẩm trong giỏ hàng!');
                }
            });

            // Hàm định dạng số
            function numberFormat(number) {
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
        });
    </script>
@endsection
