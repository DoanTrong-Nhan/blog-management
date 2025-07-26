<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký</h2>

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Tên" value="{{ old('name') }}" required><br><br>

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br><br>

        <input type="password" name="password" placeholder="Mật khẩu" required><br><br>

        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required><br><br>

        <button type="submit">Đăng ký</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
</body>
</html>
