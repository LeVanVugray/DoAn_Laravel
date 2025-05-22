<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::check() ? Auth::user()->name : 'My Account' }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if (Auth::check())
                            @if(Auth::user()->role === 0)
                            <a href="{{ url('/admin/indexadmin') }}" class="dropdown-item">Admin</a>
                            @endif
                            <a href="{{ route('logout') }}" class="dropdown-item" type="button"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="dropdown-item" type="button">Sign in</a>
                            <a href="{{ route('user.createUser') }}" class="dropdown-item" type="button">Sign up</a>
                            @endif
                        </div>
                    </div>

                    <div class="btn-group mx-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">EUR</button>
                            <button class="dropdown-item" type="button">GBP</button>
                            <button class="dropdown-item" type="button">CAD</button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">AR</button>
                            <button class="dropdown-item" type="button">RU</button>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Multi</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="fa fa-angle-right float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                            <a href="{{ route('detail') }}" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down mt-1"></i></a>
                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="{{ route('cart') }}" class="dropdown-item">Shopping Cart</a>
                                    <a href="{{ route('checkout') }}" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">

            <!-- Cart Items Section -->
            <div class="col-lg-8 table-responsive mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Items</span>
                </h5>

                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Add to Checkout</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        {{-- {{ dd($cart) }} --}}
                        @foreach($cartItems as $item)

                        <tr data-cart-item-id="{{ $item->cart_item_id }}">
                            <!-- Product info -->
                            <td class="align-middle">
                                <img src="{{ asset($item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    style="width:50px; height:auto; margin-right: 10px;">
                                {{ $item->product->name }}
                            </td>
                            <!-- Price -->
                            <td class="align-middle price-cell" data-price="{{ $item->product ? $item->product->price : 0 }}">
                                ${{ $item->product ? number_format($item->product->price, 2) : '0.00' }}
                            </td>
                            <!-- Size (sử dụng quan hệ và thuộc tính size_value) -->
                            <td class="align-middle">
                                {{ $item->size ? $item->size->size_value : '' }}
                            </td>
                            <!-- Color (sử dụng quan hệ và thuộc tính color_name) -->
                            <td class="align-middle">
                                {{ $item->color ? $item->color->color_name : '' }}
                            </td>

                            <form action="{{ route('cart.checkout', $item->cart_item_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn chuyển sản phẩm này sang thanh toán?');">
                                @csrf
                                <!-- Quantity -->
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="number" name="quantity-input" id="quantity-input" value="{{ $item->quantity }}" required
                                            class="form-control form-control-sm bg-secondary border-0 text-center quantity-input">

                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <!-- Total (price x quantity) -->
                                <td class="align-middle total-cell">
                                    ${{ number_format(($item->product ? $item->product->price : 0) * $item->quantity, 2) }}
                                </td>

                                <td class="align-middle">
                                    <button type="submit" class="btn btn-primary">Add to Checkout</button>
                                </td>
                            </form>
                            <td class="align-middle">
                                <a href="{{ route('cartItem.Delete', $item->cart_item_id) }}"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i> Remove
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Phan Trang -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $cartItems->links() }}
                </div>
                <!-- Phan Trang/End -->
            </div>

            <div class="col-lg-4">



                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Tổng số tiền sản phẩm</h6>
                            <h6 class="font-weight-medium" id="overallTotal"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tiền ship</h6>
                            <h6 class="font-weight-medium" id="shippingCost"></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Tổng số tiền</h5>
                            <h5></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>

            <div>
                <button id="toggleCheckoutList" class="btn btn-primary mt-3">
                    Xem sản phẩm đã chọn
                </button>

                <!-- Phần hiển thị danh sách sản phẩm đã thêm (mặc định ẩn đi) -->
                <div id="checkoutList" class="mt-3" style="display: none; border: 1px solid #ddd; padding: 15px;">
                    <h3>Sản phẩm để thanh toán</h3>
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach($cartCheckouts as $item)
                            <tr>
                                <td class="align-middle">
                                    {{ $item->product->name }}
                                </td>
                                <td class="align-middle price-cell" data-price="{{ $item->product ? $item->product->price : 0 }}">
                                    ${{ $item->product ? number_format($item->product->price, 2) : '0.00' }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->size ? $item->size->size_value : '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->color ? $item->color->color_name : '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $item->quantity }}
                                </td>
                                <td class="align-middle line-total-cell">
                                    ${{ $item->product ? number_format($item->product->price * $item->quantity, 2) : '0.00' }}
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.checkout.delete', $item->getKey()) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cart End -->
            <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
            <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
            <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
            <script src="{{ asset('mail/jqBootstrapValidation.min.js')}}"></script>
            <script src="{{ asset('mail/contact.js')}}"></script>
            <script src="{{ asset('js/main.js')}}"></script>


            <script>
                document.getElementById("toggleCheckoutList").addEventListener("click", function() {
                    var checkoutList = document.getElementById("checkoutList");
                    if (checkoutList.style.display === "none") {
                        checkoutList.style.display = "block";
                    } else {
                        checkoutList.style.display = "none";
                    }
                });
            </script>

            <script>
                $(document).ready(function() {
                    // Khi giá trị số lượng thay đổi (sự kiện 'input' hoặc 'change')
                    $('.quantity-input').on('input change', function() {
                        // Lấy số lượng mới
                        var newQuantity = parseFloat($(this).val());
                        if (isNaN(newQuantity)) {
                            newQuantity = 0;
                        }
                        // Tìm hàng <tr> chứa input này
                        var row = $(this).closest('tr');
                        // Lấy giá từ thuộc tính data-price của cell có class '.price-cell'
                        var price = parseFloat(row.find('.price-cell').data('price'));
                        if (isNaN(price)) {
                            price = 0;
                        }
                        // Tính tổng mới
                        var total = price * newQuantity;
                        // Cập nhật cell có class '.total-cell'
                        row.find('.total-cell').text('$' + total.toFixed(2));
                    });
                });
            </script>

            <script>
                // Tăng số lượng
                document.querySelectorAll('.btn-plus').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const row = btn.closest('tr');
                        const qtyInput = row.querySelector('.quantity-input');
                        let currentQty = parseInt(qtyInput.value) || 0;
                        qtyInput.value = currentQty;
                        // Gợi ý: kích hoạt sự kiện 'input' để cập nhật total ngay sau khi thay đổi số lượng
                        qtyInput.dispatchEvent(new Event('input'));
                    });
                });

                // Giảm số lượng
                document.querySelectorAll('.btn-minus').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const row = btn.closest('tr');
                        const qtyInput = row.querySelector('.quantity-input');
                        let currentQty = parseInt(qtyInput.value) || 0;
                        if (currentQty >= 1) {
                            qtyInput.value = currentQty;
                            // Gợi ý: kích hoạt sự kiện 'input' để cập nhật total ngay sau khi thay đổi số lượng
                            qtyInput.dispatchEvent(new Event('input'));
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let overallTotal = 0;
                    // Lấy tất cả các ô của cột "Total"
                    const totalCells = document.querySelectorAll('.line-total-cell');
                    totalCells.forEach(function(cell) {
                        // Lấy nội dung của ô
                        let text = cell.textContent.trim();
                        // Loại bỏ ký hiệu "$" và dấu phân cách (nếu có)
                        text = text.replace('$', '').replace(/,/g, '');
                        const lineTotal = parseFloat(text) || 0;
                        overallTotal += lineTotal;
                    });

                    let shippingCost = overallTotal * 0.10;
                    document.getElementById('shippingCost').textContent = '$' + shippingCost.toFixed(2);

                    // Cập nhật tổng chung vào phần tử có id overallTotal
                    document.getElementById('overallTotal').textContent = '$' + overallTotal.toFixed(2);
                });
            </script>

</body>

</html>