@extends('admin.layout')

@section('title', 'Products')

@section('content')
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>Product List</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>Product List</li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-warning">Add</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="cr-card card-default product-list">
                        <div class="cr-card-content ">
                            <div class="table-responsive">
                                <table id="product_list" class="table" style="width:100%">
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
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Stock</th>
                                            <th>Sold</th>
                                            <th>Created At</th>
                                            <th>Deleted At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.products.show', $product->id) }}">
                                                        <img class="tbl-thumb" src={{ Storage::url($product->image) }}
                                                            alt="Product Image" width="100" height="100">
                                                    </a>
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>${{ $product->price }}</td>
                                                @if ($product->sale_price)
                                                    <td>${{ $product->sale_price }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $product->quantity }}</td>
                                                <td><span class="active">{{ $product->sold_count }}</span></td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->deleted_at }}</td>
                                                <td>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            Edit
                                                        </a>
                                                        @if ($product->deleted_at)
                                                            <form
                                                                action="{{ route('admin.products.restore', $product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-outline-dark"
                                                                    onclick="return confirm('Restore this product?')">
                                                                    Restore
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.products.destroy', $product->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Delete this product?')">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
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
@endsection

@section('script')

@endsection
