{{-- resources/views/DoAn_NhomF/admin/products.blade.php --}}
@include('DoAn_NhomF.admin.header')

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

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <form method="GET" action="{{ route('admin.productadmin') }}" style="display: flex; gap: 10px;">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search..." class="form-control">
                
                <select name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High</option>
                </select>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
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
                    <img src="{{ $product->image ? asset('AnhDoAn/' . $product->image) : asset('img/no-image.png') }}" alt="Product Image">
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-description">
                            {{ \Illuminate\Support\Str::limit($product->description, 100, '...') }}
                        </div>
                        <div class="product-price">${{ $product->price }}</div>
                    </div>
                    <div class="product-actions">
                        <a href="{{ route('form_edit_product', ['product_id' => $product->product_id]) }}" class="btn btn-success btn-mini">Edit</a>
                        <a href="{{ route('deleteProduct', ['product_id' => $product->product_id]) }}"
                            class="btn btn-danger btn-mini"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                        </a>
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
