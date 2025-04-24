{{-- resources/views/DoAn_NhomF/admin/products.blade.php --}}
@include('DoAn_NhomF.admin.header')

<!-- start-top-search-->
<div id="search">
    <form action="" method="get">
        <input type="text" name="keyword" id="product-search" placeholder="Search here..." />
        <button type="submit" class="tip-bottom" title="Search">
            <i class="icon-search icon-white"></i>
        </button>
    </form>
</div>
<!-- close-top-search -->

@include('DoAn_NhomF.admin.sidebar')

<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Manage Products</h1>
    </div>

    <div class="widget-content" style="padding: 20px;">
        <!-- Create Product button -->
        <div class="mb-3" style="margin-bottom: 20px; display: flex; justify-content: flex-end;">
            <a href="{{ route('form_add_product') }}" class="btn btn-primary">
                <i class="icon-plus"></i> Create Product
            </a>
        </div>

        <!-- Product Grid -->
        <style>
            .product-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .product-card {
                flex: 1 1 calc(25% - 20px);
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s ease;
            }

            .product-card:hover {
                transform: translateY(-5px);
            }

            .product-card img {
                width: 100%;
                height: 180px;
                object-fit: cover;
            }

            .product-info {
                flex-grow: 1;
                padding: 15px;
                font-size: 14px;
            }

            .product-name {
                font-weight: bold;
                margin-bottom: 8px;
            }

            .product-description {
                color: #666;
                font-size: 13px;
                line-height: 1.4;
                max-height: 55px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .product-price {
                font-weight: bold;
                color: #28a745;
                margin-top: 10px;
            }

            .product-actions {
                display: flex;
                justify-content: space-around;
                padding: 10px 15px;
                border-top: 1px solid #eee;
                background: #f9f9f9;
            }
        </style>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/no-image.png') }}" alt="Product Image">
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-description">
                            {{ \Illuminate\Support\Str::limit($product->description, 100, '...') }}
                        </div>
                        <div class="product-price">${{ $product->price }}</div>
                    </div>
                    <div class="product-actions">
                        <a href="#" class="btn btn-success btn-mini">Edit</a>
                        <a href="#" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination justify-content-center" style="margin-top: 20px;">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- END CONTENT -->
<div class="row-fluid">
    <div id="footer" class="span12">2025 &copy; TDC - Lập trình web 1</div>
</div>

@include('DoAn_NhomF.admin.footer')
