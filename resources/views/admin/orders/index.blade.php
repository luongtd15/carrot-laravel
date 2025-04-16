@extends('admin.layout')

@section('title', 'Orders')

@section('content')
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>Order List</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>Order List</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="cr-card" id="ordertbl">
                        <div class="cr-card-header">
                            <h4 class="cr-card-title">Recent Orders</h4>
                            <div class="header-tools">
                                <a href="javascript:void(0)" class="m-r-10 cr-full-card"><i
                                        class="ri-fullscreen-line"></i></a>
                                <div class="cr-date-range dots">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="cr-card-content card-default">
                            <div class="order-table">
                                <div class="table-responsive">
                                    <table id="recent_order" class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="token">#{{ $order->id }}</td>
                                                    <td>{{ $order->user->email }}</td>
                                                    <td class="active">${{ $order->total_amount }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>
                                                        {{ $order->created_at }}
                                                    </td>
                                                    <td> {{ $order->address->full_address }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                            class="btn btn-outline-primary btn-sm d-flex gap-1">
                                                            <i class="ri-edit-2-line"></i>
                                                            <span>See more</span>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
