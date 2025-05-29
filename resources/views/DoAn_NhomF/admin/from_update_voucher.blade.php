@include('DoAn_NhomF.admin.header')
@include('DoAn_NhomF.admin.sidebar')
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Update User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Item info</h5>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger" style="margin: 15px 20px;">
                        <strong>Đã xảy ra lỗi:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="{{route('post_from_update_voucher')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                             <input type="hidden" name="updated_at" value="{{ $voucher->updated_at }}">
                            <input type="hidden" name="voucher_id" value="{{ $voucher->voucher_id }}">
                            {{-- Mã voucher --}}
                            <div class="control-group">
                                <label class="control-label">Code</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="code" value="{{ $voucher->code }}" required autofocus />*
                                    @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- code -->
                            <!-- <div class="control-group">
                                <label class="control-label">Code </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="code" required autofocus/> *
                                    @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                                </div>
                            </div> -->

                            {{-- Mô tả --}}
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="description" value="{{ $voucher->description }}" required autofocus />*
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- mô tả -->

                            <!-- <div class="control-group">
                                <label class="control-label">Description
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="description" required autofocus/> *
                                    @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                </div>
                            </div> -->

                            {{-- Loại giảm giá --}}
                            <div class="control-group">
                                <label class="control-label">Discount Type</label>
                                <div class="controls">
                                    <select name="discount_type" class="span11" required autofocus>
                                        <option value="percent" {{ $voucher->discount_type == 'percent' ? 'selected' : '' }}>Percent</option>
                                        <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>

                                    @if ($errors->has('discount_type'))
                                    <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                    @endif
                                </div>
                            </div>


                            {{-- Giá trị giảm --}}
                            <div class="control-group">
                                <label class="control-label">Discount Value</label>
                                <div class="controls">
                                    <input type="number" step="0.01" name="discount_value" class="span11" value="{{ old('discount_value') ?? $voucher->discount_value }}" required />
                                    @if ($errors->has('discount_value'))
                                    <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Giảm tối đa nếu là % --}}
                            <div class="control-group">
                                <label class="control-label">Max Discount</label>
                                <div class="controls">
                                    <input type="number" step="0.01" name="max_discount" class="span11" value="{{ old('max_discount') ?? $voucher->max_discount }}" />
                                    @if ($errors->has('max_discount'))
                                    <span class="text-danger">{{ $errors->first('max_discount') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Giá trị đơn hàng tối thiểu --}}
                            <div class="control-group">
                                <label class="control-label">Min Order Value</label>
                                <div class="controls">
                                    <input type="number" step="0.01" name="min_order_value" class="span11" value="{{ old('min_order_value') ?? $voucher->min_order_value }}" />
                                    @if ($errors->has('min_order_value'))
                                    <span class="text-danger">{{ $errors->first('min_order_value') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Số lượng --}}
                            <div class="control-group">
                                <label class="control-label">Quantity</label>
                                <div class="controls">
                                    <input type="number" name="quantity" class="span11" value="{{ old('quantity') ?? $voucher->quantity }}" required />
                                    @if ($errors->has('quantity'))
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Ngày bắt đầu --}}
                            <div class="control-group">
                                <label class="control-label">Start Date</label>
                                <div class="controls">
                                    <input type="date" name="start_date" class="span11" value="{{ old('start_date', \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d')) }}" required />
                                    @if ($errors->has('start_date'))
                                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Ngày kết thúc --}}
                            <div class="control-group">
                                <label class="control-label">End Date</label>
                                <div class="controls">
                                    <input type="date" name="end_date" class="span11" value="{{ old('end_date', \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d')) }}" required />
                                    @if ($errors->has('end_date'))
                                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Trạng thái --}}
                            <div class="control-group">
                                <label class="control-label">Status</label>
                                <div class="controls">
                                    <select name="status" class="span11" required>
                                        <option value="1" {{ (int)(old('status') ?? $voucher->status) === 1 ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="0" {{ (int)(old('status') ?? $voucher->status) === 0 ? 'selected' : '' }}>Không kích hoạt</option>
                                    </select>

                                    @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>


                            {{-- Nút submit --}}
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@include('DoAn_NhomF.admin.footer')