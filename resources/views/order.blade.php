@extends('layout')

@section('title', 'Your Order')
@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Checkout</h2>
                            <span> <a href="index.html">Home</a> - Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout section -->
    <section class="cr-checkout-section padding-tb-100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="cr-checkout-rightside col-lg-4 col-md-12">
                    <div class="cr-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title"></h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-pro">
                                    @foreach ($order->orderDetails as $item)
                                        <div class="col-sm-12 mb-6">
                                            <div class="cr-product-inner">
                                                <div class="cr-pro-image-outer">
                                                    <div class="cr-pro-image">
                                                        <a href="" class="image">
                                                            <img class="main-image"
                                                                src="{{ asset('assets/img/product/1.jpg') }}"
                                                                alt="Product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="cr-pro-content cr-product-details">
                                                    <h5 class="cr-pro-title">
                                                        <a href="">
                                                            {{ $item->product->name }} <span>
                                                                <span class="cr-pro-quantity">x{{ $item->quantity }}</span>
                                                        </a>
                                                    </h5>
                                                    <div class="cr-pro-rating">
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-fill"></i>
                                                        <i class="ri-star-line"></i>
                                                    </div>
                                                    <p class="cr-price"><span class="new-price">
                                                            <span class="new-price">${{ $item->price }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cr-checkout-summary">
                                    <div class="cr-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">${{ $order->total_amount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-checkout-pay-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">{{ $order->status }}</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-pay">
                                    <div class="cr-pay-desc"></div>
                                    <div class="cr-pay-option mb-10">

                                    </div>
                                    <button class="btn btn-danger mt-10">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                </div>

                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            <div class="cr-checkout-wrap">
                                <div class="cr-checkout-block cr-check-bill">
                                    <h3 class="cr-checkout-title">Shipping Address</h3>
                                    <div class="cr-bl-block-content">
                                        <div class="cr-check-bill-form mb-minus-24">
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Name*</label>
                                                <input type="text" name="name" placeholder="Enter your name"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Address *</label>
                                                <input type="text" name="address" placeholder=""
                                                    value="{{ $order->address->address }}">
                                            </div>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>Commune *</label>
                                                <input type="text" name="commune" placeholder=""
                                                    value="{{ $order->address->commune }}">
                                            </div>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>District *</label>
                                                <input type="text" name="district" placeholder=""
                                                    value="{{ $order->address->district }}">
                                            </div>
                                            <div class="cr-bill-wrap cr-bill-half">
                                                <label>City *</label>
                                                <input type="text" name="city" placeholder=""
                                                    value="{{ $order->address->city }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection
