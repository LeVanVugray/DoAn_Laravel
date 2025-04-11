<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/stylel.css')}}">
</head>
<body>

<nav>
    <a href="{{ route('indexexe') }}">Home</a>
    <a href="{{ route('loginexe') }}">Đăng nhập</a>
    <a href="{{ route('registerexe') }}">Đăng ký</a>
</nav>

<div class="container">
    <h2>Màn hình đăng ký</h2>
    <input type="text" id="username" placeholder="Username">
    <input type="password" id="password" placeholder="Mật khẩu">
    <input type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu">
    <input type="email" id="email" placeholder="Email">
    <p id="error-message" style="color: red;"></p>
    <button onclick="validateRegister()">Đăng ký</button>
</div>

<script>
    function validateRegister() {
        let username = document.getElementById("username").value.trim();
        let password = document.getElementById("password").value.trim();
        let confirmPassword = document.getElementById("confirmPassword").value.trim();
        let email = document.getElementById("email").value.trim();
        let errorMessage = document.getElementById("error-message");

        // Kiểm tra nếu có trường nào trống
        if (username === "" || password === "" || confirmPassword === "" || email === "") {
            errorMessage.textContent = "Vui lòng nhập đầy đủ thông tin!";
            return;
        }

        // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng nhau không
        if (password !== confirmPassword) {
            errorMessage.textContent = "Mật khẩu nhập lại không khớp!";
            return;
        }

        // Kiểm tra email có hợp lệ không
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessage.textContent = "Email không hợp lệ!";
            return;
        }

        // Nếu tất cả hợp lệ -> Hiển thị thông báo & chuyển hướng
        alert("Đăng ký thành công!");
        window.location.href = "{{ route('loginexe') }}"; // Chuyển đến trang welcome
    }
</script>

</body>
</html>
