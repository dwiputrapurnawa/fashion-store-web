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

    <div class="mb-3 title-background">
        <h5>{{ $category->name }}</h5>
    </div>

   <div class="row">
    @foreach ($products as $product)
    <a class="col-lg mt-3 mb-3 text-decoration-none" href="/product/{{ $product->slug }}">
    <div class="card product-item col-lg mt-3 mb-3" style="width: 18rem;">
        <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="card-img-top" alt="card-img">
        <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">Rp. {{ $product->price }}</p>
        
            <div class="mb-3">
                <i class="fa-solid fa-star" style="color: yellow;"></i>
                <p class="card-text d-inline text-secondary">4.9 | Terjual 5.9K</p>
            </div>

        <form action="/cart" method="post">
            @csrf
            <button type="submit" class="btn custom-btn w-100">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
            </form>

        </div>
    </div>
    </a>
    @endforeach
    
    {{ $products->links() }}
   </div>
@endsection