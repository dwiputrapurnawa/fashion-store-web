@extends('layouts.main')

@section('title')
    {{ $category->name }}
@endsection

@section('content')



<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($category->name) }}</li>
    </ol>
  </nav>

  
  @if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

  <div class="row">
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