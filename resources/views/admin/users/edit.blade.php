@extends('admin.layout')

@section('title', $user->email)

@section('content')
    <!-- main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- Page title & breadcrumb -->
            <div class="cr-page-title cr-page-title-2">
                <div class="cr-breadcrumb">
                    <h5>{{ $user->name }}</h5>
                    <ul>
                        <li><a href="index.html">Carrot</a></li>
                        <li>{{ $user->name }}</li>
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
                <div class="col-xxl-12 col-xl-12 col-md-12">
                    <div class="cr-card vendor-profile">
                        <div class="cr-card-content vendor-details mb-m-30">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Account Details</h3>
                                    <div class="cr-vendor-detail">
                                        <p>From your account you can easily view and track orders. You can manage
                                            and change your account information like address, contact information
                                            and history of orders.</p>
                                        @if (auth()->id() === $user->id)
                                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-dark"
                                                style="border-radius: 0px; font-size: small;">Edit Profile</a>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="cr-vendor-detail">
                                        <h6>E-mail address</h6>
                                        <ul>
                                            <li><strong>Email : </strong>{{ $user->email }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="cr-vendor-detail">
                                        <h6>Contact nubmer</h6>
                                        <ul>
                                            <li><strong>Phone Nubmer : </strong>{{ $user->phone }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="cr-vendor-detail">
                                        <h6>Address</h6>
                                        <ul>
                                            @foreach ($user->addresses as $address)
                                                <li>
                                                    - {{ $address->full_address }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="cr-vendor-detail">
                                        <h6>Role</h6>
                                        <form action="{{ route('admin.users.update', ['user' => $user->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            @if (auth()->id() === $user->id)
                                                <ul>
                                                    <li>
                                                        <span>{{ strtoupper($user->role) }}</span>
                                                    </li>
                                                    <li>
                                                        <span class="text-danger">You cannot change your own role.</span>
                                                    </li>
                                                </ul>
                                            @else
                                                <select name="role" id="role" class="form-control">
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                </select>
                                                @error('role')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <button type="submit" class="btn btn-outline-dark mt-2"
                                                    style="border-radius: 0px; font-size: small;">Update Role</button>
                                            @endif
                                        </form>
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
