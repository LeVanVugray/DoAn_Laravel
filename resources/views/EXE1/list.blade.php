<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/stylel.css')}}">
</head>
<body>

<nav>
    <a href="{{ route('indexexe') }}">Home</a>
    <a href="{{ route('indexexe') }}">Đăng xuất</a>
</nav>

<div class="container">
    <h2>Danh sách user</h2>
    <table border="1" width="100%">
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        <tr>
            <td>1</td>
            <td>levanvu</td>
            <td>levanvu@gmail.com</td>
            <td><a href="{{ route('updateexe') }}">Edit</a> | <a href="{{ route('viewexe') }}">View</a> | <a href="#">Delete</a></td>
        </tr>
        
    </table>
</div>

</body>
</html>
