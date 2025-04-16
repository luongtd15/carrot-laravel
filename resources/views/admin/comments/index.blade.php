@extends('admin.layout')

@section('title', 'Orders')

@section('content')
    <style>
        .ri-star-s-fill {
            color: #f5885f;
        }

        .ri-star-s-line {
            color: #f5c0b2;
        }
    </style>
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>Comment List</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>Comment List</li>
                    </ul>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="cr-card" id="ordertbl">
                        <div class="cr-card-header">
                            <h4 class="cr-card-title">Recent Comments</h4>
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
                                                <th>#ID</th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th>Rating</th>
                                                <th>Content</th>
                                                <th>Deleted At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comments as $comment)
                                                <tr>
                                                    <td>{{ $comment->id }}</td>
                                                    <td class="">
                                                        {{ $comment->user->email }}
                                                    </td>
                                                    <td class="">
                                                        {{ $comment->product->name }}
                                                    </td>
                                                    <td>
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $comment->rating)
                                                                <i class="ri-star-s-fill"></i>
                                                            @else
                                                                <i class="ri-star-s-line"></i>
                                                            @endif
                                                        @endfor
                                                    </td>
                                                    <td class="">
                                                        {{ Str::limit($comment->content, 25, '...') }}
                                                    </td>
                                                    <td>{{ $comment->deleted_at }}</td>
                                                    @auth
                                                        @if (Auth::user()->role === 'admin')
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <!-- Nút "Details" -->
                                                                    <a href="{{ route('admin.comments.show', $comment) }}"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        Details
                                                                    </a>

                                                                    <!-- Nút "Delete" -->
                                                                    <form
                                                                        action="{{ route('admin.comments.destroy', $comment) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-danger">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    @endauth
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
