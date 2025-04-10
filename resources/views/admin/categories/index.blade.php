@extends('admin.layout')

@section('title', 'Categories')

@section('content')
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">

                    <h5>Category List</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>Category List</li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-dark">Add</a>
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
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Deleted At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($byDescCategories as $category)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.categories.show', $category->id) }}">
                                                        <img class="tbl-thumb" src="{{ Storage::url($category->image) }}"
                                                            alt="Product Image" width="100" height="100">
                                                    </a>
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td><span class="active">{{ $category->description }}</span></td>
                                                <td>
                                                    {{ $category->created_at }}
                                                </td>
                                                <td>
                                                    {{ $category->deleted_at }}
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            Edit
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.categories.destroy', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this category?')">
                                                                Delete
                                                            </button>
                                                        </form>
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
