@extends('admin.layout')

@section('title', 'Edit Order')

@section('content')
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="cr-card cr-invoice max-width-1170">
                        <div class="cr-card-header">
                            <h4 class="cr-card-title">Order #{{ $order->id }}</h4>
                        </div>


                        <div class="invoice-wrapper">

                            <div class="cr-card-content card-default">
                                <div class="row">
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
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-3 col-sm-6">
                                        <img src="{{ asset('admin/assets/img/logo/full-logo.png') }}" alt="logo">

                                        <address>
                                            <br> 321, Porigo alto, new st george church, Nr. Jogas garden, USA.
                                        </address>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-sm-6">
                                        <p class="text-dark mb-2">From</p>

                                        <address>
                                            <span>Carrot</span>
                                            <br> 47 Elita Squre, VIP Chowk,
                                            <br> <span>Email:</span> example@gmail.com
                                            <br> <span>Phone:</span> +91 5264 251 325
                                        </address>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <p class="text-dark mb-2">To</p>

                                        <address>
                                            <span class="text-success">{{ $order->user->name }}</span>
                                            <br> {{ $order->address->full_address }}
                                            <br> <span>Email</span>: {{ $order->user->email }}
                                            <br> <span>Phone:</span> {{ $order->user->phone }}
                                        </address>
                                    </div>
                                </div>
                                <div class="cr-chart-header">
                                    <div class="block">
                                        <h6>Order</h6>
                                        <h5>#{{ $order->id }}
                                        </h5>
                                    </div>
                                    <div class="block">
                                        <h6>Amount</h6>
                                        <h5>${{ $order->total_amount }}
                                        </h5>
                                    </div>
                                    <div class="block">
                                        <h6>Status</h6>
                                        @php
                                            $allowedTransitions = [
                                                'pending' => ['confirmed', 'canceled'],
                                                'confirmed' => ['delivering', 'canceled'],
                                                'delivering' => ['completed', 'canceled'],
                                                'completed' => [],
                                                'canceled' => [],
                                            ];
                                            $statuses = ['pending', 'confirmed', 'delivering', 'completed', 'canceled'];
                                            $current = $order->status;
                                            $allowed = $allowedTransitions[$current] ?? [];
                                        @endphp

                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
                                            class="d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status }}"
                                                        {{ $current === $status ? 'selected' : '' }}
                                                        {{ $status !== $current && !in_array($status, $allowed) ? 'disabled' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    </div>

                                    <div class="block">
                                        <h6>Date</h6>
                                        <h5>
                                            {{ $order->created_at }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <div>
                                        <table class="table-invoice table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Product</th>
                                                    <th>Short_Description</th>
                                                    <th>Quantity</th>
                                                    <th>Unit_Cost</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($order->orderDetails as $item)
                                                    <tr>
                                                        <td>{{ $item->product->id }}</td>
                                                        <td>
                                                            @if ($item->product->image)
                                                                @if (filter_var($item->product->image, FILTER_VALIDATE_URL))
                                                                    <img id="mainImage" src="{{ $item->product->image }}"
                                                                        class="invoice-item-image"
                                                                        alt="{{ $item->product->name }}"
                                                                        data-original-src="{{ $item->product->image }}">
                                                                @else
                                                                    <img id="mainImage"
                                                                        src="{{ Storage::url($item->product->image) }}"
                                                                        class="invoice-item-image"
                                                                        alt="{{ $item->product->name }}"
                                                                        data-original-src="{{ Storage::url($item->product->image) }}">
                                                                @endif
                                                            @else
                                                                <div id="mainImage" class="invoice-item-image"
                                                                    data-original-src="">
                                                                    No Image
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>{{ $item->product->short_description }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>${{ $item->product->price }}</td>
                                                        <td>${{ $item->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row justify-content-end inc-total">
                                    <div class="col-lg-9 order-lg-1 order-md-2 order-sm-2">
                                        <div class="note">
                                            <label>Note</label>
                                            <p>Your country territory tax has been apply.</p>
                                            <p>Your voucher cannot be applied, because you enter wrong code.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 order-lg-2 order-md-1 order-sm-1">
                                        <ul class="list-unstyled">
                                            <li class="text-dark">Total
                                                <span
                                                    class="d-inline-block float-right">${{ number_format($order->total_amount, 2, ',', '.') }}</span>
                                            </li>
                                        </ul>
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

@endsection
