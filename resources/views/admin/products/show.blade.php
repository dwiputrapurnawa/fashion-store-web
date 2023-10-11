@extends('layouts.dashboard')

{{-- @section('title')
    Show {{ $product->name }}
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-lg-auto">
            <img class="img-fluid mb-2 img-view img-thumbnail" src="/{{ $product->images[0]->path }}">
            <div class="img-list">
                @foreach ($product->images as $image)
                <img class="img-fluid img-thumbnail mb-2 img-item" src="/{{ $image->path }}">
                @endforeach
            </div>
        </div>
        <div class="col-lg">
            <div class="row">
                <div class="col-sm-auto">
                    <h5>{{ $product->name }}</h5>
                </div>
                <div class="col-sm">
                    <span class="badge text-bg-info">{{ $product->category->name }}</span>
                </div>
            </div>
            
            
            <div class="row">
                <p class="d-inline col-sm-auto">Sold 100+</p>
                <div class="d-inline col-sm-auto">
                    <i class="fa-solid fa-star" style="color: #ffc800;"></i> {{ round($product->getAvgRating(), 1) }}
                    <p class="d-inline">({{ $product->user_rating->count() }} Rating)</p>
                </div>
                <p class="d-inline col-sm-auto">Discussion ({{ $product->comments->count() }})</p>
                <p class="d-inline col-sm-auto">Stock ({{ $product->stock }})</p>
            </div>
            <h3 class="fw-bold product-price currency d-inline">Rp.@money($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price)</h3>

            @if ($product->discount)
                <div class="mb-3">
                <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                <small class="card-text text-decoration-line-through">Rp.@money($product->price)</small>
                </div>
            @endif
            <hr>

            <p class="text-wrap">{!! $product->description !!}</p>
        </div>
    </div>
@endsection