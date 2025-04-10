@extends('admin.layout')

@section('title', '# ' . $product->id . $product->name)

@section('content')
    <div class="cr-main-content">
        <div class="container-fluid">
            <div class="py-5">
                <div class="container">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card border-0">
                                        <!-- Ảnh chính -->
                                        <div class="main-image-container">
                                            @if ($product->image)
                                                @if (filter_var($product->image, FILTER_VALIDATE_URL))
                                                    <img id="mainImage" src="{{ $product->image }}"
                                                        class="card-img-top rounded shadow" alt="{{ $product->name }}"
                                                        data-original-src="{{ $product->image }}">
                                                @else
                                                    <img id="mainImage" src="{{ Storage::url($product->image) }}"
                                                        class="card-img-top rounded shadow" alt="{{ $product->name }}"
                                                        data-original-src="{{ Storage::url($product->image) }}">
                                                @endif
                                            @else
                                                <div id="mainImage"
                                                    class="bg-secondary text-white d-flex justify-content-center align-items-center"
                                                    style="height: 200px;" data-original-src="">
                                                    Không có image
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Ảnh phụ -->
                                        @if ($product->images->isNotEmpty())
                                            <div class="mt-3">
                                                <div class="row g-2">
                                                    @foreach ($product->images as $image)
                                                        <div class="col-4">
                                                            <img src="{{ Storage::url($image->image_path) }}"
                                                                class="img-thumbnail rounded shadow-sm additional-image"
                                                                style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;"
                                                                alt="Additional image"
                                                                data-src="{{ Storage::url($image->image_path) }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="h3 fw-bold text-dark">#{{ $product->id . ' ' . $product->name }}</h1>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="{{ route('admin.products.index') }}"
                                                    class="btn btn-secondary">Back</a>
                                            </div>
                                        </div>
                                        <div class="sub-title">{{ $product->slug }}</div>

                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <small class="text-muted">Stock</small>
                                                <p class="text-dark">{{ $product->quantity }}</p>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <small class="text-muted">Sold</small>
                                                <p class="text-dark">{{ $product->sold_count }}</p>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <small class="text-muted">Price</small>
                                                <p class="price">
                                                    @if (!empty($product->sale_price))
                                                        <span class="text-dark">${{ $product->sale_price }}</span>
                                                        <span class="old-price"
                                                            style="text-decoration: line-through; color: gray;">${{ $product->price }}</span>
                                                    @else
                                                        <span class="text-dark">${{ $product->price }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <small class="text-muted">Created_at</small>
                                                <p class="text-dark">{{ $product->created_at }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <h2 class="h5 fw-semibold text-dark">Short Description</h2>
                                        <p class="mt-2 text-dark white-space-pre-line">{{ $product->short_description }}
                                        </p>
                                    </div>

                                    <div>
                                        <h2 class="h5 fw-semibold text-dark">Description</h2>
                                        <p class="mt-2 text-dark white-space-pre-line">{{ $product->description }}</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const additionalImages = document.querySelectorAll('.additional-image');
            const originalSrc = mainImage.getAttribute('data-original-src');

            additionalImages.forEach(image => {
                // Khi di chuột vào ảnh phụ
                image.addEventListener('mouseover', function() {
                    mainImage.src = this.getAttribute('data-src');
                });

                // Khi chuột rời khỏi ảnh phụ
                image.addEventListener('mouseout', function() {
                    mainImage.src = originalSrc;
                });
            });
        });
    </script>
@endsection
