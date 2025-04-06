@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    @if (Auth::guard('admin')->check())
        <p>Chào mừng Admin!</p>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit">Đăng xuất Admin</button>
        </form>
    @else
        <p>Bạn không có quyền truy cập.</p>
    @endif
@endsection
