@extends('layout')

@section('title', 'My Orders')

@section('content')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>My Orders</h2>
                            <span> <a href="index.html">Home</a> - Privacy Policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Policy section -->
    <section class="cr-policy padding-tb-100" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2>My Orders</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>You can see your orders here!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="cr-common-wrapper spacing-991">
                        <div class="cr-cgi-block">
                            @forelse ($orders as $order)
                                <div class="d-flex justify-content-between mb-3 bg-light p-3 rounded align-items-center">
                                    <p class="flex-fill mb-0"><strong>Order#{{ $order->id }}</strong></p>
                                    <p class="flex-fill mb-0">{{ $order->status }}</p>
                                    <p class="flex-fill mb-0">${{ $order->total_amount }}</p>
                                    <p class="flex-fill mb-0">{{ $order->created_at }}</p>
                                    <a href="{{ route('order.show', ['user' => Auth::user()->id, 'order' => $order->id]) }}"
                                        class="flex-fill mb-0 btn btn-outline-primary text-center d-flex justify-content-center align-items-center">
                                        Details
                                    </a>
                                </div>
                            @empty
                                <div class="" style="text-align: center; padding: 20px;">
                                    <p class="mb-3">You have not placed any orders yet.</p>
                                    <a href="{{ route('products') }}" class="cr-button"
                                        style="">{{ strtoupper('Start Shopping Now') }}</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- Policy section End -->
@endsection
