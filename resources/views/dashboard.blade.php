<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Chào {{ Auth::user()->name }}</h2>

    <p>Email: {{ Auth::user()->email }}</p>
    <p>Vai trò: {{ Auth::user()->role->name ?? 'Chưa phân quyền' }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>
