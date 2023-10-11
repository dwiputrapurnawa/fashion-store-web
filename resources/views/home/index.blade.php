@extends('layouts.main')

@section('title')
    Fashion Store - Home
@endsection

@section('content')

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    @include('partials.carousel')

    <hr>


   <div class="deals-container" id="deals">
    <h5 class="title-background">Deals</h5>


    <div class="owl-carousel owl-theme row">
      @foreach ($productDeals as $productDeal)
      <div class="col-sm-auto card product-item m-3">
        <a href="/product/{{ $productDeal->product->slug }}">
          <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="card-img-top" alt="card-img">
        </a>
        <div class="card-body">
          <a class="text-decoration-none text-dark" href="/product/{{ $productDeal->product->slug }}"><h5 class="card-title">{{ Str::ucfirst($productDeal->product->name) }}</h5></a>
          <p class="card-text">Rp. @money($productDeal->product->price - (($productDeal->percentage / 100) * $productDeal->product->price))</p>
          
          <div class="mb-3">
            <span class="badge text-bg-danger">{{ $productDeal->percentage }}%</span>
            <small class="card-text text-decoration-line-through">Rp. @money($productDeal->product->price)</small>
          </div>

          
            <div class="mb-3">
              <i class="fa-solid fa-star" style="color: #ffc800;"></i>
                <p class="card-text d-inline text-secondary">{{ round($productDeal->product->getAvgRating(), 2) }} | Terjual 5.9K</p>
            </div>
  
          <form action="/cart" method="post">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="product_id" value="{{ $productDeal->product->id }}">
            <button type="submit" class="btn custom-btn w-100">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
          </form>
  
        </div>
      </div>
     @endforeach
    </div>  
   </div>

    

   <hr>

   
   <div class="row" id="product-list">
    
    <h5 class="title-background">All Product</h5>

   @foreach ($products as $product)

    <div class="col-lg-auto card product-item m-3">
        <a href="/product/{{ $product->slug }}">
          <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="card-img-top" alt="card-img">
        </a>
        <div class="card-body">
          <a class="text-decoration-none text-dark" href="/product/{{ $product->slug }}"><h5 class="card-title">{{ Str::ucfirst($product->name) }}</h5></a>
          <p class="card-text">Rp. @money($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price)</p>

          @if ($product->discount)
            <div class="mb-3">
              <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
              <small class="card-text text-decoration-line-through">Rp. @money($product->price)</small>
            </div>
          @endif
          
            <div class="mb-3">
              <i class="fa-solid fa-star" style="color: #ffc800;"></i>
                <p class="card-text d-inline text-secondary">{{ round($product->getAvgRating(), 1) }} | Terjual 5.9K</p>
            </div>

          <form action="/cart" method="post">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn custom-btn w-100">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
          </form>

        </div>
      </div>
   @endforeach
   {{ $products->links() }}
   </div>
@endsection