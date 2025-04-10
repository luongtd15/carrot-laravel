@extends('admin.layout')

@section('title', 'Add New Category')

@section('content')
    <style>
        /* Hiển thị lỗi dưới các input, với khoảng cách hợp lý */
        .input-error {
            color: #dc3545;
            /* Màu đỏ để lỗi nổi bật */
            font-size: 0.875rem;
            /* Chữ nhỏ hơn một chút */
            opacity: 0.8;
            /* Làm mờ chữ để nhẹ nhàng hơn */
            margin-top: 7px;
            /* Khoảng cách giữa input và lỗi */
        }

        /* Tạo hiệu ứng cho lỗi khi focus vào input */
        input:invalid {
            border-color: #dc3545;
            /* Đổi màu border thành màu đỏ khi input có lỗi */
        }
    </style>
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="row cr-category">
                <div class="col-xl-4 col-lg-12">
                    <div class="team-sticky-bar">
                        <div class="col-md-12">
                            <div class="cr-cat-list cr-card card-default mb-24px">
                                <div class="cr-card-content">
                                    <div class="cr-cat-form">
                                        <h3>Add New Category</h3>

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

                                        <form action='{{ route('admin.categories.store') }}' method="post"
                                            id="categoryForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="col-12">
                                                    <input id="name" name="name"
                                                        class="form-control here slug-title" type="text"
                                                        value='{{ old('name') }}'>
                                                    <div id="nameError" class="input-error"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="col-12">
                                                    <input id="image" name="image" class="form-control here set-slug"
                                                        type="file">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label>Description</label>
                                                <div class="col-12">
                                                    <textarea id="description" name="description" cols="40" rows="2" class="form-control">{{ old('description') }}</textarea>
                                                </div>
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-12 d-flex">
                                                    <button type="submit" class="cr-btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12">
                    <div class="cr-cat-list cr-card card-default">
                        <div class="cr-card-content ">
                            <div class="table-responsive">
                                <table id="cat_data_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    <a href="">
                                                        <img class="tbl-thumb"
                                                            src="{{ Storage::url($category->image) }}"
                                                            alt="Product Image" width="75">
                                                    </a>
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td><span class="active">{{ $category->description }}</span></td>
                                                <td>
                                                    {{ $category->created_at }}
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
    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault(); // Ngừng việc submit mặc định

                // Xóa lỗi cũ
                $('#nameError').text('');

                // Tạo formData từ form
                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route('admin.categories.store') }}',
                    method: 'POST',
                    data: formData,
                    processData: false, // Để giữ dữ liệu file
                    contentType: false, // Để trình duyệt không thêm kiểu content
                    success: function(response) {
                        // Xử lý thành công
                        alert(response.success);

                        // Chuyển hướng đến trang chỉnh sửa của category
                        var editUrl =
                            '{{ route('admin.categories.edit', ['category' => '__category_id__']) }}';
                        editUrl = editUrl.replace('__category_id__', response.category.id);

                        window.location.href = editUrl; // Chuyển hướng
                    },
                    error: function(response) {
                        // Xử lý lỗi
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;

                            // Hiển thị lỗi của trường "name"
                            if (errors.name) {
                                $('#nameError').text(errors.name[0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
