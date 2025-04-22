@extends('admin.layout')

@section('title', 'Add new user')

@section('content')
@section('content')
    <style>
        .input-error {
            color: #dc3545;
            font-size: 0.875rem;
            opacity: 0.8;
            margin-top: 7px;
        }

        input:invalid {
            border-color: #dc3545;
        }
    </style>

    <div class="cr-main-content">
        <div class="container-fluid">
            <div class="row cr-category">
                <div class="col-xl-6 col-lg-12">
                    <div class="cr-card card-default mb-24px">
                        <div class="cr-card-content">
                            <div class="cr-cat-form">
                                <h3>Add New User</h3>

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('admin.users.store') }}" method="post" id="userForm">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input name="name" class="form-control" type="text"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="input-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" class="form-control" type="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="input-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" class="form-control" type="password">
                                        @error('password')
                                            <div class="input-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" class="form-control" type="text"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="input-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control">
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        @error('role')
                                            <div class="input-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="cr-btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bạn có thể thêm phần hiển thị danh sách user ở cột bên cạnh -->
                <div class="col-xl-6 col-lg-12">
                    <div class="cr-cat-list cr-card card-default">
                        <div class="cr-card-content ">
                            <div class="table-responsive">
                                <table id="cat_data_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                                        {{ $user->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    {{ $user->phone }}
                                                </td>
                                                <td><span class="active">{{ $user->role }}</span></td>
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

@endsection

@section('script')

@endsection
