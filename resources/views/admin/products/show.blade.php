@extends('layouts.dashboard')

@section('title')
    Preview {{ $product->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-auto">
            <img class="img-fluid mb-2 img-view img-thumbnail" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            <div class="img-list">
                <img class="img-fluid img-thumbnail mb-2 img-item" src="https://storage.sg.content-cdn.io/cdn-cgi/image/%7Bwidth%7D,%7Bheight%7D,quality=75,format=auto/in-resources/ff5c6da1-2d74-4846-96c9-ccd65d766244/Images/ProductImages/Source/Levis-Mens-Relaxed-Fit-Graphic-Zip-Up-Hoodie-387170020_01_Front.jpg">
                <img class="img-fluid img-thumbnail mb-2 img-item" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            </div>
        </div>
        <div class="col-lg">
            <h5>{{ $product->name }}</h5>
            <div class="row">
                <p class="d-inline col-sm-auto">Sold 100+</p>
                <div class="d-inline col-sm-auto">
                    <i class="fa-solid fa-star" style="color: #ffc800;"></i> {{ round($product->getAvgRating(), 1) }}
                    <p class="d-inline">({{ $product->user_rating->count() }} rating)</p>
                </div>
                <p class="d-inline col-sm-auto">Discussion ({{ $product->comments->count() }})</p>
            </div>
            <h3 class="fw-bold product-price currency d-inline">{{ $product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price }}</h3>

            @if ($product->discount)
                <div class="mb-3">
                <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                <small class="card-text currency text-decoration-line-through">{{ $product->price }}</small>
                </div>
            @endif
            <hr>

            <p class="text-wrap">{{ $product->description }}</p>
        </div>
    </div>
@endsection