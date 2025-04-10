@extends('admin.layout')

@section('title', 'Add new product')

@section('content')
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>Add Product</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>Add Product</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="cr-card card-default">
                        <div class="cr-card-content">
                            <div class="row cr-product-uploads">
                                <form class="row g-3" action="{{ route('admin.products.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-4 mb-991">
                                        <div class="cr-vendor-img-upload">
                                            <div class="cr-vendor-main-img">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="image" name="image"
                                                            class="cr-image-upload" accept=".png, .jpg, .jpeg" multiple>
                                                        <label><i class="ri-pencil-line"></i></label>
                                                    </div>
                                                    <div class="avatar-preview cr-preview">
                                                        <div class="imagePreview cr-div-preview">
                                                            <img class="cr-image-preview"
                                                                src="assets/img/product/preview.jpg" alt="product-preview">
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="multi-image-upload">
                                                <div class="row" id="additional_images_preview">
                                                    <!-- Preview ảnh sẽ hiển thị ở đây -->
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
                                                        name="name" value="{{ old('name') }}">
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
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="short_description" class="form-label">Short Description</label>
                                                <textarea class="form-control" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <label class="form-label">Price * <span>( In USD )</span></label>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        min="0" step="0.01" value="{{ old('price') }}">
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Sale Price</label>
                                                    <input type="number" class="form-control" id="sale_price"
                                                        name="sale_price" min="0" step="0.01"
                                                        value="{{ old('sale_price') }}">
                                                    @error('sale_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Quantity *</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity" min="0" value="{{ old('quantity') }}">
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control form-select" name="is_active">
                                                        <option value="1"
                                                            {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="0"
                                                            {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                    @error('is_active')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Featured</label>
                                                <select class="form-control form-select" name="is_featured">
                                                    <option value="0"
                                                        {{ old('is_featured', 0) == 0 ? 'selected' : '' }}>Normal</option>
                                                    <option value="1"
                                                        {{ old('is_featured', 0) == 1 ? 'selected' : '' }}>Featured
                                                    </option>
                                                </select>
                                                @error('is_featured')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <label for="description" class="form-label">Full Description</label>
                                                <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
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
                                                        value="{{ old('slug') }}" readonly>
                                                </div>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mt-1">
                                                <button type="submit" class="btn cr-btn-primary">Submit</button>
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
        // Xử lý hiển thị preview nhiều ảnh phụ
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('additional_images');
            if (!input) {
                console.error('id="additional_images" is not exist');
                return;
            }

            input.addEventListener('change', function(e) {
                const previewContainer = document.getElementById('additional_images_preview');
                if (!previewContainer) {
                    console.error('#additional_images_preview is not exist');
                    return;
                }
                previewContainer.innerHTML = '';

                console.log('Số file đã chọn:', this.files.length);
                if (this.files.length > 5) {
                    alert('5 photos are maximum');
                    this.value = '';
                    return;
                }

                Array.from(this.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        console.log('Đã tải xong ảnh thứ', index);
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
                                if (index !== i) dt.items.add(files[i]);
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
        });

        // Auto generate slug from product name
        document.getElementById('name').addEventListener('input', function() {
            if (document.getElementById('generate_slug').checked) {
                const name = this.value;
                const randomNum = Math.floor(Math.random() * 1000) + 1;
                const slug = name.toLowerCase().replace(/[^\w\s]/gi, '').replace(/\s+/g, '-') + '-' + randomNum;
                document.getElementById('slug').value = slug;
            }
        });

        // Toggle slug field editability
        document.getElementById('generate_slug').addEventListener('change', function() {
            document.getElementById('slug').readOnly = this.checked;
            if (this.checked) {
                // Trigger slug generation if name exists
                const name = document.getElementById('name').value;
                if (name) {
                    document.getElementById('name').dispatchEvent(new Event('input'));
                }
            }
        });
    </script>
@endsection
