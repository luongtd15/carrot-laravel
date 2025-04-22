@extends('layout')

@section('title', $category->name)

@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Detail of category "{{ $category->name }}"</h2>
                            <span> <a href="index.html">Home</a> - Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop -->
    <section class="section-shop padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Categories</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            @if ($products->isEmpty())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                            <div class="cr-banner">
                                <h2>Sorry!</h2>
                            </div>
                            <div class="cr-banner-sub-title">
                                <p>We couldn't find any products matching your search.</p>
                                <p class="text text-primary">Please try again with different keywords.</p>
                                <div class="cr-banner-button mt-5 d-flex justify-content-center">
                                    <button class="cr-button">
                                        <a href="" class="cr-button">Discover for more products</a>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @else
                <div class="row mb-minus-24">
                    <div class="col-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                        <div class="row">
                            <div class="col-12">
                                <div class="cr-shop-bredekamp">
                                    <div class="cr-toggle">
                                        <a href="javascript:void(0)" class="gridCol active-grid">
                                            <i class="ri-grid-line"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="gridRow">
                                            <i class="ri-list-check-2"></i>
                                        </a>
                                    </div>
                                    <div class="center-content">
                                        <span>We found {{ $products->total() }} items for you!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-50 mb-minus-24">
                            @foreach ($products as $product)
                                <div class="col-lg-3 col-6 cr-product-box mb-24">
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
                                            <a href="{{ route('product.show', $product->id) }}" class="title">
                                                {{ $product->name }}
                                            </a>
                                            @if (!empty($product->short_description))
                                                <p class="text text-primary">{{ $product->short_description }}</p>
                                            @endif
                                            <p class="text" style="text-align: justify">
                                                {{ Str::limit($product->description, 50, '...') }}</p>
                                            <p class="cr-price">
                                                <span class="new-price">${{ $product->price }}</span>
                                                @if (!empty($product->sale_price))
                                                    <span class="old-price">${{ $product->sale_price }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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

                            .pagination {
                                margin-top: 10px;
                            }
                        </style>

                        <!-- Render Pagination -->
                        <div class="mt-10">
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Model -->
    <div class="modal fade quickview-modal" id="quickview" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered cr-modal-dialog">
            <div class="modal-content">
                <button type="button" class="cr-close-model btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
