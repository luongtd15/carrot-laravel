@extends('admin.layout')

@section('title', 'Edit Product #' . $product->id . ' ' . $product->name)

@section('content')
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>Edit Product #{{ $product->id }}</h5>
                    <ul>
                        <li><a href="{{ route('admin.products.index') }}">Carrot</a></li>
                        <li>Edit Product</li>
                    </ul>
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
                <div class="col-md-12">
                    <div class="cr-card card-default">
                        <div class="cr-card-content">
                            <div class="row cr-product-uploads">
                                <form class="row g-3" action="{{ route('admin.products.update', $product->id) }}"
                                    method="POST" enctype="multipart/form-data" id="editProductForm">
                                    @csrf
                                    @method('PUT')

                                    <div class="col-lg-4 mb-991">
                                        <div class="cr-vendor-img-upload">
                                            <!-- Ảnh chính -->
                                            <div class="cr-vendor-main-img">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="image" name="image"
                                                            class="cr-image-upload" accept=".png, .jpg, .jpeg">
                                                        <label><i class="ri-pencil-line"></i></label>
                                                    </div>
                                                    <div class="avatar-preview cr-preview">
                                                        <div class="imagePreview cr-div-preview">
                                                            @if ($product->image)
                                                                @if (filter_var($product->image, FILTER_VALIDATE_URL))
                                                                    <img src="{{ $product->image }}" alt="product-tab-1"
                                                                        class="cr-image-preview">
                                                                @else
                                                                    <img src="{{ Storage::URL($product->image) }}"
                                                                        alt="product-tab-1" class="cr-image-preview">
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <small class="text-muted d-block mt-1">Leave blank to keep current
                                                    image</small>
                                            </div>

                                            <!-- Ảnh phụ -->
                                            <div class="multi-image-upload mt-3">
                                                <div class="row" id="additional_images_preview">
                                                    @foreach ($product->images as $image)
                                                        <div class="col-4 mb-3" data-image-id="{{ $image->id }}">
                                                            <div class="image-thumb-container position-relative">
                                                                <img src="{{ Storage::url($image->image_path) }}"
                                                                    class="img-thumbnail"
                                                                    style="height: 100px; width: 100%; object-fit: cover;">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-xs position-absolute top-0 end-0 delete-image"
                                                                    data-image-id="{{ $image->id }}">
                                                                    <i class="ri-close-line"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-3">
                                                    <input type="file" id="additional_images" name="additional_images[]"
                                                        multiple accept=".png, .jpg, .jpeg" style="display: none;">
                                                    <button type="button" class="btn btn-sm cr-btn-secondary"
                                                        onclick="document.getElementById('additional_images').click()">
                                                        <i class="ri-add-line"></i> Add Images
                                                    </button>
                                                    <small class="text-muted d-block mt-1">Maximum 5 images (800x800px
                                                        recommended)</small>
                                                    @error('additional_images.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="cr-vendor-upload-detail">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">Product name *</label>
                                                    <input type="text" class="form-control slug-title" id="name"
                                                        name="name" value="{{ old('name', $product->name) }}">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Category *</label>
                                                    <select class="form-control form-select" name="category_id">
                                                        <option value="">-- Select Category --</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label for="short_description" class="form-label">Short Description</label>
                                                <textarea class="form-control" name="short_description" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Price * <span>( In USD )</span></label>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        min="0" step="0.01"
                                                        value="{{ old('price', $product->price) }}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Sale Price</label>
                                                    <input type="number" class="form-control" id="sale_price"
                                                        name="sale_price" min="0" step="0.01"
                                                        value="{{ old('sale_price', $product->sale_price) }}">
                                                    @error('sale_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Quantity *</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity" min="0"
                                                        value="{{ old('quantity', $product->quantity) }}">
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control form-select" name="is_active">
                                                        <option value="1"
                                                            {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                                                            Active</option>
                                                        <option value="0"
                                                            {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                    @error('is_active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label class="form-label">Featured</label>
                                                <select class="form-control form-select" name="is_featured">
                                                    <option value="0"
                                                        {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>
                                                        Normal</option>
                                                    <option value="1"
                                                        {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>
                                                        Featured</option>
                                                </select>
                                                @error('is_featured')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label for="description" class="form-label">Full Description</label>
                                                <textarea class="form-control" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="generate_slug"
                                                        checked>
                                                    <label class="form-check-label" for="generate_slug">Auto generate
                                                        slug</label>
                                                </div>
                                                <label for="slug" class="col-12 col-form-label">Slug</label>
                                                <div class="col-12">
                                                    <input id="slug" name="slug"
                                                        class="form-control here set-slug" type="text"
                                                        value="{{ old('slug', $product->slug) }}" readonly>
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-3 d-flex gap-2">
                                                <button type="submit" class="btn cr-btn-primary">Update</button>
                                                <a href="{{ route('admin.products.index') }}"
                                                    class="btn btn-secondary ms-2">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
            console.log('DOM fully loaded'); // Debug

            // Preview ảnh chính
            const mainImageInput = document.getElementById('image');
            if (mainImageInput) {
                mainImageInput.addEventListener('change', function(e) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('.cr-image-preview').src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                });
            }

            // Preview và xóa ảnh phụ mới
            const additionalImagesInput = document.getElementById('additional_images');
            if (additionalImagesInput) {
                additionalImagesInput.addEventListener('change', function(e) {
                    const previewContainer = document.getElementById('additional_images_preview');
                    const currentImageCount = previewContainer.querySelectorAll('.col-4').length;
                    const newFiles = Array.from(this.files);
                    const totalImages = currentImageCount + newFiles.length;

                    if (totalImages > 5) {
                        alert('Maximum 5 images allowed');
                        this.value = '';
                        return;
                    }

                    newFiles.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-4 mb-3';

                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'image-thumb-container position-relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail';
                            img.style.height = '100px';
                            img.style.width = '100%';
                            img.style.objectFit = 'cover';

                            const deleteBtn = document.createElement('button');
                            deleteBtn.type = 'button';
                            deleteBtn.className =
                                'btn btn-danger btn-xs position-absolute top-0 end-0';
                            deleteBtn.innerHTML = '<i class="ri-close-line"></i>';
                            deleteBtn.onclick = function() {
                                col.remove();
                                const dt = new DataTransfer();
                                const input = document.getElementById('additional_images');
                                const {
                                    files
                                } = input;

                                for (let i = 0; i < files.length; i++) {
                                    if (i !== index) dt.items.add(files[i]);
                                }
                                input.files = dt.files;
                            };

                            imgContainer.appendChild(img);
                            imgContainer.appendChild(deleteBtn);
                            col.appendChild(imgContainer);
                            previewContainer.appendChild(col);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Xóa ảnh phụ hiện có
            const deleteButtons = document.querySelectorAll('.delete-image');
            console.log('Found delete buttons:', deleteButtons.length); // Debug
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-image-id');
                    const col = this.closest('.col-4');
                    col.remove();

                    // Thêm input ẩn để gửi ID ảnh cần xóa
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_images[]';
                    deleteInput.value = imageId;
                    document.getElementById('editProductForm').appendChild(deleteInput);

                    // Debug
                    console.log('Added delete_images[] with ID:', imageId);
                });
            });

            // Auto generate slug
            document.getElementById('name').addEventListener('input', function() {
                if (document.getElementById('generate_slug').checked) {
                    const name = this.value;
                    const randomNum = Math.floor(Math.random() * 1000) + 1;
                    const slug = name.toLowerCase().replace(/[^\w\s]/gi, '').replace(/\s+/g, '-') + '-' +
                        randomNum;
                    document.getElementById('slug').value = slug || '';
                }
            });

            document.getElementById('generate_slug').addEventListener('change', function() {
                const slugInput = document.getElementById('slug');
                slugInput.readOnly = this.checked;
                if (this.checked) {
                    const name = document.getElementById('name').value;
                    if (name) {
                        document.getElementById('name').dispatchEvent(new Event('input'));
                    } else {
                        slugInput.value = '';
                    }
                }
            });
        });
    </script>
@endsection
