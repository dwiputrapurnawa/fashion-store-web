@extends('layouts.main')

@section('title')
    Fashion Store - Wishlist
@endsection

@section('content')


<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
    </ol>
</nav>

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if ($products->isEmpty())

<div class="empty">
  <img src="/images/wish-list.png" alt="wishlist-image" class="img-fluid" style="width: 10rem;">
  <h2 class="mb-4 mt-3">Your Wishlist is <span class="fw-bold" style="color: #8F5E2E">Empty!</span></h2>
  <a class="btn custom-btn w-100" href="/">Return to Shop</a>
</div>

@else
<div class="row">
  @foreach ($products as $product)
   <div class="col-lg-auto card product-item m-3" style="width: 18rem;">
       <a href="/product/{{ $product->slug }}">
         <img src="/{{ $product->images[0]->path ?? "images/no-image.jpg" }}" class="card-img-top" alt="card-img">
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
            @if (!$product->user_rating->isEmpty())
              <i class="fa-solid fa-star" style="color: #ffc800;"></i>
              <p class="card-text d-inline text-secondary">{{ round($product->getAvgRating(), 2) }} | Terjual 5.9K</p>              
            @endif
          </div>

           <div class="row">
              <form class="col-sm" action="/cart" method="post">
                  @csrf
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" class="btn custom-btn w-100">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
              </form>
     
                  <div class="col-sm-auto">
                      <button class="btn btn-danger float-end" type="button" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $product->name }}"><i class="fa-solid fa-trash"></i></button>
                    </div>
           </div>
         

       </div>
     </div>

     <div class="modal fade" id="confirmDelete{{ $product->name }}" tabindex="-1" aria-labelledby="confirmDelete" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Confirm Delete</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/wishlist" method="POST">
            @csrf
            @method("delete")
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="modal-body">
              Are you sure delete this item from your wishlist?
            </div>
          <div class="modal-footer">
            <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">No</button>
            <button type="submit" class="btn custom-btn">Yes</button>
          </div>
    
        </form>
        </div>
      </div>
    </div>
  @endforeach
  
  </div>
@endif

 

@endsection