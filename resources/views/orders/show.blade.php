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
                            <h2>Order Detail</h2>
                            <span> <a href="index.html">Home</a> - Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cr-track padding-t-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Popular Products</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>We delivering happiness and needs, Faster than you can think.</p>
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
                <div class="container">
                    <div class="cr-track-box">
                        <!-- Details-->
                        <div class="row">
                            <div class="col-md-4 m-b-767">
                                <div class="cr-track-card"><span
                                        class="cr-track-title">order</span><span>#{{ $order->id }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 m-b-767">
                                <div class="cr-track-card"><span class="cr-track-title">user</span>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 m-b-767">
                                <div class="cr-track-card"><span class="cr-track-title">Order date</span><span>
                                        {{ $order->created_at }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Track Order section End -->

    <!-- Checkout section -->
    <section class="cr-checkout-section padding-b-100 pt-5">
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
                                                        <a href="{{ route('product.show', $item->product->id) }}"
                                                            class="image">
                                                            @if ($item->product->image)
                                                                @if (filter_var($item->product->image, FILTER_VALIDATE_URL))
                                                                    <img src="{{ $item->product->image }}"
                                                                        alt="product-tab-1" class="product-image">
                                                                @else
                                                                    <img src="{{ Storage::URL($item->product->image) }}"
                                                                        alt="product-tab-1" class="product-image">
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="cr-pro-content cr-product-details">
                                                    <h5 class="cr-pro-title">
                                                        <a href="{{ route('product.show', ['id' => $item->product->id]) }}">
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
                            <div class="cr-sb-title mb-4">
                                <h3 class="cr-sidebar-title text-center text-uppercase font-weight-bold"
                                    style="color: #007bff;">{{ $order->status }}</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-pay">
                                    <div class="cr-pay-desc mb-3">
                                        <p class="text-muted" style="text-align: center">You can see the order status or
                                            cancel the order here.</p>
                                    </div>
                                    <div class="cr-pay-option mb-4">
                                        <!-- Optional content, like payment methods or further details -->
                                    </div>
                                    @if (!in_array($order->status, ['canceled', 'delivering', 'delivered', 'completed']))
                                        <div class="d-flex justify-content-center mt-4">
                                            <form
                                                action="{{ route('order.cancel', ['user' => Auth::user()->id, 'order' => $order->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-danger btn-lg w-100" type="submit"
                                                    onclick="return confirm('Cancel this order?')">Cancel
                                                    Order</button>
                                            </form>
                                        </div>
                                    @else
                                    @endif
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
                                    <div class="cr-bl-block-content">
                                        <style>
                                            .custom-display-box {
                                                padding: 16px;
                                                font-size: 1.1rem;
                                                background-color: #f9f9f9;
                                                border: 1px solid #ccc;
                                                border-radius: 0;
                                                /* Không bo góc */
                                                line-height: 1.6;
                                                min-height: 50px;
                                            }
                                        </style>
                                        <div class="cr-check-bill-form mb-4 p-3">
                                            <h3 class="cr-checkout-title">Shipping Address</h3>
                                            <!-- Name + Phone -->
                                            <div class="row mb-3">
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-bold">Name*</label>
                                                    <div class="custom-display-box">{{ Auth::user()->name }}</div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label fw-bold">Phone*</label>
                                                    <div class="custom-display-box">{{ Auth::user()->phone }}</div>
                                                </div>
                                            </div>

                                            <!-- Full Address -->
                                            <div class="mb-2">
                                                <label class="form-label fw-bold">Full Address</label>
                                                <div class="custom-display-box">{{ $order->address->full_address }}</div>
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
