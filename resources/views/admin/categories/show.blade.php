@extends('admin.layout')

@section('title', 'Categories')

@section('content')
    <div class="cr-main-content">
        <div class="container-fluid">
            <div class="py-5">
                <div class="container">
                    <div class="card shadow-sm">
                        <div class="card-body">


                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card">
                                        @if ($category->image)
                                            @if (filter_var($category->image, FILTER_VALIDATE_URL))
                                                <img src="{{ $category->image }}" class="card-img-top rounded shadow"
                                                    alt="{{ $category->name }}">
                                            @else
                                                <img src="{{ Storage::url($category->image) }}"
                                                    class="card-img-top rounded shadow" alt="{{ $category->name }}">
                                            @endif
                                        @else
                                            <div class="bg-secondary text-white d-flex justify-content-center align-items-center"
                                                style="height: 200px;">
                                                Không có image
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h1 class="h3 fw-bold text-dark">{{ $category->name }}</h1>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                    class="btn btn-primary">
                                                    Edit
                                                </a>
                                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                                    Back
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted">Created_at</small>
                                                <p class="text-dark">{{ $category->created_at }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h2 class="h5 fw-semibold text-dark">Description</h2>
                                        <p class="mt-2 text-dark white-space-pre-line">{{ $category->description }}</p>
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
