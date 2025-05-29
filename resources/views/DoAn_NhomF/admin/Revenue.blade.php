<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card {
            position: relative;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin: 15px 0;
            min-height: 100px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .card div:first-child {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #4e73df;
            margin-bottom: 10px;
        }

        .card div:nth-child(2) {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        .card .icon {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #ddd;
        }
    </style>
    {{-- resources/views/DoAn_NhomF/admin/revenue.blade.php --}}
    @include('DoAn_NhomF.admin.header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <div id="search">
        <form action="" method="get">
            <input type="text" name="keyword" placeholder="Search here..." />
            <button type="submit" class="tip-bottom" title="Search">
                <i class="icon-search icon-white"></i>
            </button>
        </form>
    </div>

    @include('DoAn_NhomF.admin.sidebar')

    <!-- BEGIN CONTENT -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="" title="Go to Home" class="tip-bottom current">
                    <i class="icon-home"></i> Home
                </a>
            </div>
            <h1>THỐNG KÊ</h1>
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        {{-- Card Start --}}
                        @php
                        
                        @endphp

                        @foreach ($cards as $card)
                        <div class="span3">
                            <div class="card" style="border-left: 5px solid #1cc88a;">
                                <div class="card-title" style="font-size: 13px; font-weight: bold; text-transform: uppercase; color: #1cc88a; margin-bottom: 8px;">
                                    {{ $card['label'] }}
                                </div>
                                <div class="card-value" style="font-size: 22px; font-weight: bold; color: #333;">
                                    {{ $card['value'] }}
                                </div>
                                <div class="icon">
                                    <i class="fas {{ $card['icon'] }} fa-2x"></i>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        {{-- Card End --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END CONTENT -->

    <div class="row-fluid">
        <div id="footer" class="span12">2025 &copy; TDC - Lập trình web 1</div>
    </div>

    @include('DoAn_NhomF.admin.footer')