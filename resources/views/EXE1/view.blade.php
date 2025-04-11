<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/stylel.css')}}">
</head>
<body>

<nav>
    <a href="{{ route('indexexe') }}">Home</a>
    <a href="{{ route('indexexe') }}">Đăng xuất</a>
</nav>

<div class="container">
    <h2>Màn hình chi tiết</h2>
    <p><strong>Username:</strong> levanvu</p>
    <p><strong>Email:</strong> levanvu@gmail.com</p>
    <button onclick="redirectToIndex()">Chỉnh sửa</button>
</div>
<script>
    function redirectToIndex() {
        window.location.href = "{{ route('listexe') }}";
    }
</script>
</body>
</html>
