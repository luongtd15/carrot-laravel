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
                                    @foreach ($carts as $item)
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
                                                            <span class="new-price">${{ $item->total_price }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cr-checkout-summary">
                                    <div class="cr-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span class="text-right">${{ $totalPrice }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>

                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            <div class="cr-checkout-wrap">
                                <div class="cr-checkout-block cr-check-bill">
                                    <h3 class="cr-checkout-title">Shipping Address</h3>
                                    <div class="cr-bl-block-content">
                                        <div class="cr-check-bill-form mb-minus-24">
                                            <form action="{{ route('order.add') }}" method="post">
                                                @csrf
                                                <!-- Danh sách địa chỉ có sẵn -->
                                                <div class="cr-bill-wrap cr-bill">
                                                    <label>Select an existing address</label>
                                                    @php
                                                        $user = Auth::user();
                                                        $addresses = $user->addresses;
                                                    @endphp
                                                    @if ($addresses->isNotEmpty())
                                                        <select name="address_id" class="form-control">
                                                            <option value="">-- Select Address --</option>
                                                            @foreach ($addresses as $addr)
                                                                <option value="{{ $addr->id }}"
                                                                    {{ $addr->is_default ? 'selected' : '' }}>
                                                                    {{ $addr->full_address }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <p>No saved addresses found.</p>
                                                    @endif
                                                </div>

                                                <!-- Nhập địa chỉ mới -->
                                                <div class="cr-bill-wrap cr-bill mt-30">
                                                    <label>Or enter a new address:</label>
                                                </div>
                                                <div class="cr-bill-wrap cr-bill-half">
                                                    <label>Address *</label>
                                                    <input type="text" name="new_address[address]"
                                                        placeholder="Address Line 1">
                                                </div>
                                                <span class="cr-bill-wrap cr-bill-half">
                                                    <label>Commune *</label>
                                                    <input type="text" name="new_address[commune]" placeholder="Commune">
                                                </span>
                                                <span class="cr-bill-wrap cr-bill-half">
                                                    <label>District *</label>
                                                    <input type="text" name="new_address[district]"
                                                        placeholder="District">
                                                </span>
                                                <span class="cr-bill-wrap cr-bill-half">
                                                    <label>City *</label>
                                                    <input type="text" name="new_address[city]" placeholder="City">
                                                </span>
                                                <span class="cr-bill-wrap cr-bill mb-30">
                                                    <button class="cr-button" type="submit">Place Order</button>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="cr-check-order-btn d-flex gap-2 float-start">
                                <a href="{{ route('cart') }}" class="cr-button mt-30">Back To Cart</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection
