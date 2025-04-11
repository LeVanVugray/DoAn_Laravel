<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="col-lg-4">
                <a href="{{ route('index') }}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="auth-container">
        <div class="auth-left"></div>
        <div class="auth-right">
            <div class="auth-card">
                <h4 class="text-center mb-3">Register</h4>
                <form action="{{ route('user.postUser') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" autofocus>
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address">
                        @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Sign Up</button>
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                        <p class="mb-3">---------- or ----------</p>
                    </div>
                    <a href="{{ url('auth/google') }}" class="btn btn-danger w-100">Sign up with Google</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('img/payments.png')}}" alt="">
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>