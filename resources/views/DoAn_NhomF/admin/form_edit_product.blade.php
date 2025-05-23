@include('DoAn_NhomF.admin.header')
@include('DoAn_NhomF.admin.sidebar')

<div id="content">
    <div id="content-header">
        <h1>Edit Product</h1>
    </div>
    <div class="container-fluid">
        <form action="{{ route('post_edit_product') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input type="text" name="name" value="{{ $product->name }}" class="span11" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="description" class="span11" required>{{ $product->description }}</textarea>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="span11" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Category</label>
                <div class="controls">
                    <select name="category_id" class="span11" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                    <input type="file" name="image" class="span11">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2">
                    @endif
                    
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update Product</button>
            </div>
        </form>
    </div>
</div>

@include('DoAn_NhomF.admin.footer')
