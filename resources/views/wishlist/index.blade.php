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

<div class="row">

    @foreach ($products as $product)
     <div class="col-lg-auto card product-item m-3" style="width: 18rem;">
         <a href="/product/{{ $product->slug }}">
           <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="card-img-top" alt="card-img">
         </a>
         <div class="card-body">
           <a class="text-decoration-none text-dark" href="/product/{{ $product->slug }}"><h5 class="card-title">{{ Str::ucfirst($product->name) }}</h5></a>
           <p class="card-text currency">{{ $product->price }}</p>
           
             <div class="mb-3">
                 <i class="fa-solid fa-star" style="color: yellow;"></i>
                 <p class="card-text d-inline text-secondary">4.9 | Terjual 5.9K</p>
             </div>
 
             <div class="row">
                <form class="col-lg" action="/cart" method="post">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn custom-btn w-100">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                </form>
       
                    <div class="col-lg-auto">
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

@endsection