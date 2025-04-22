@extends('layout')

@section('title', 'Home')

@section('content')
    {{-- slider --}}
    <section class="section-hero padding-b-100 next">
        <div class="cr-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-two">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-one">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="section-popular margin-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>SHIRTS COLLECTION</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Make your life brighter! </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="cr-twocolumns-product-1">
                        @foreach ($shirts as $product)
                            <div class="slick-slide">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <img src="{{ Storage::URL($product->image) }}" alt="product-1">
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
                                            <a href="{{ route('category.show', $product->category->id) }}">
                                                {{ $product->category->name }}
                                            </a>
                                            <div class="cr-star">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                                <p>(4.5)</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('product.show', $product->id) }}" class="title">
                                            {{ $product->name }}
                                        </a>
                                        <p class="cr-price">
                                            @if (!empty($product->sale_price))
                                                <span class="new-price">${{ $product->sale_price }}</span>
                                                <span class="old-price" style="text-decoration: line-through; color: gray;">
                                                    ${{ $product->price }}
                                                </span>
                                            @else
                                                <span class="new-price">${{ $product->price }}</span>
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

    <!-- Feature product -->
    <section class="section-popular-product-shape padding-b-100">

        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>TROUSERS</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-content row mb-minus-24" id="MixItUpDA2FB7">
                <div class="col-xl-3 col-lg-4 col-12 mb-24">
                    <div class="row mb-minus-24 sticky">

                        {{-- <div class="col-lg-12 col-sm-6 col-6 cr-product-box mb-24">
                            <div class="cr-product-tabs">
                                <ul>
                                    <li class="active" data-filter="all">All</li>
                                    <li data-filter=".snack">Snack</li>
                                    <li data-filter=".vegetable">Vegetable</li>
                                    <li data-filter=".fruit">Fruit</li>
                                    <li data-filter=".bakery">Bakery</li>
                                </ul>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-sm-6 col-6 cr-product-box banner-480 mb-24">
                            <div class="cr-ice-cubes">
                                <img src="assets/img/banner/banner-3.jpg" alt="product banner">
                                <div class="cr-ice-cubes-contain">
                                    <h4 class="title">Trendy </h4>
                                    <h5 class="sub-title" style="color: black">Trousers</h5>
                                    <span style="color: darkblue">New Arrival 2025</span>
                                    <a href="shop-left-sidebar.html" class="cr-button">Shop Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-9 col-lg-8 col-12 mb-24">
                    <div class="row mb-minus-24">
                        @foreach ($trousers as $product)
                            <div class="mix vegetable col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <img src="{{ Storage::URL($product->image) }}" alt="product-1">
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
                                            <a href="{{ route('category.show', $product->category->id) }}">
                                                {{ $product->category->name }}
                                            </a>
                                            <div class="cr-star">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                                <p>(4.5)</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('product.show', $product->id) }}" class="title">
                                            {{ $product->name }}
                                        </a>
                                        <p class="cr-price">
                                            @if (!empty($product->sale_price))
                                                <span class="new-price">${{ $product->sale_price }}</span>
                                                <span class="old-price"
                                                    style="text-decoration: line-through; color: gray;">
                                                    ${{ $product->price }}
                                                </span>
                                            @else
                                                <span class="new-price">${{ $product->price }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <style>
                            /* Đổi màu trang hiện tại (active) */
                            .pagination .active span {
                                background-color: #64b496 !important;
                                /* Màu cam */
                                color: white !important;
                                border-radius: 5px;
                                padding: 6px 12px;
                                border: none !important;
                                /* Xóa viền */
                            }

                            /* Màu trang không active */
                            .pagination a {
                                padding: 6px 12px;
                                border-radius: 5px;
                                background-color: #f3f3f3;
                                color: black;
                                text-decoration: none;
                                border: none !important;
                                /* Xóa viền */
                            }

                            /* Hover effect */
                            .pagination a:hover {
                                background-color: #ddd;
                            }
                        </style>

                        <!-- Render Pagination -->
                        {{ $trousers->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-popular-product-shape padding-b-100">

        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>SHOES</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-content row mb-minus-24" id="MixItUpDA2FB7">

                <div class="col-xl-12 col-lg-12 col-12 mb-24">
                    <div class="row mb-minus-24">
                        @foreach ($shoes as $product)
                            <div class="mix vegetable col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <img src="{{ Storage::URL($product->image) }}" alt="product-1">
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
                                            <a href="{{ route('category.show', $product->category->id) }}">
                                                {{ $product->category->name }}
                                            </a>
                                            <div class="cr-star">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                                <p>(4.5)</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('product.show', $product->id) }}" class="title">
                                            {{ $product->name }}
                                        </a>
                                        <p class="cr-price">
                                            @if (!empty($product->sale_price))
                                                <span class="new-price">${{ $product->sale_price }}</span>
                                                <span class="old-price"
                                                    style="text-decoration: line-through; color: gray;">
                                                    ${{ $product->price }}
                                                </span>
                                            @else
                                                <span class="new-price">${{ $product->price }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <style>
                            /* Đổi màu trang hiện tại (active) */
                            .pagination .active span {
                                background-color: #64b496 !important;
                                /* Màu cam */
                                color: white !important;
                                border-radius: 5px;
                                padding: 6px 12px;
                                border: none !important;
                                /* Xóa viền */
                            }

                            /* Màu trang không active */
                            .pagination a {
                                padding: 6px 12px;
                                border-radius: 5px;
                                background-color: #f3f3f3;
                                color: black;
                                text-decoration: none;
                                border: none !important;
                                /* Xóa viền */
                            }

                            /* Hover effect */
                            .pagination a:hover {
                                background-color: #ddd;
                            }
                        </style>

                        <!-- Render Pagination -->
                        {{ $shoes->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product banner -->
    {{-- <section class="section-product-banner padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-banner-slider swiper-container">
                        <div class="swiper-wrapper">

                            @foreach ($categories as $category)
                                <div class="swiper-slide" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="cr-product-banner-image">
                                        <img src="assets/img/product-banner/1.jpg" alt="product-banner">
                                        <div class="cr-product-banner-contain">
                                            <h5>{{ $category->name }}</h5>

                                            <p>
                                                <span class="text">
                                                    {{ $category->description }}
                                                </span>
                                            </p>
                                            <div class="cr-product-banner-buttons">
                                                <a href="{{ route('category.show', $category->id) }}"
                                                    class="cr-button">shop now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Services -->
    <section class="section-services padding-b-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-services-border" data-aos="fade-up" data-aos-duration="1000">
                        <div class="cr-service-slider swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-red-packet-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Product Packing</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-customer-service-2-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>24X7 Support</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-truck-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Delivery in 5 Days</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-services">
                                        <div class="cr-services-image">
                                            <i class="ri-money-dollar-box-line"></i>
                                        </div>
                                        <div class="cr-services-contain">
                                            <h4>Payment Secure</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
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

    <!-- Deal -->
    <section class="section-deal padding-b-100">
        <div class="bg-banner-deal">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-deal-rightside">
                            <div class="cr-deal-content" data-aos="fade-up" data-aos-duration="1000">
                                <span><code>SALE</code> OFF</span>
                                <h4 class="cr-deal-title">Great deal on men's clothes.</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do maecenas accumsan
                                    lacus
                                    vel facilisis.
                                </p>
                                <div id="timer" class="cr-counter">
                                    <div class="cr-counter-inner">
                                        <h4>
                                            <span id="days"></span>
                                            Days
                                        </h4>
                                        <h4>
                                            <span id="hours"></span>
                                            Hrs
                                        </h4>
                                        <h4>
                                            <span id="minutes"></span>
                                            Min
                                        </h4>
                                        <h4>
                                            <span id="seconds"></span>
                                            Sec
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bestseller product -->
    {{-- <section class="section-hero padding-b-100 next">
        <div class="cr-slider swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-three">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cr-hero-banner cr-banner-image-one">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-left-side-contain slider-animation">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}
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
                                <img src="assets/img/product/tab-1.jpg" alt="product-tab-2" class="product-image">
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="cr-size-and-weight-contain">
                                <h2 class="heading">Peach Seeds Of Change Oraganic Quinoa, Brown fruit</h2>
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
                                        <button type="button" class="cr-button">Add to cart</button>
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
