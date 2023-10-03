@extends('layouts.main')

@section('title')
    Fashion Store - Cart
@endsection

@section('content')

  @if (session()->has("message"))
      <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session("message") }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

  @if ($products->isEmpty())
  
      <div class="empty" style="width: 25rem;">
        <img class="img-fluid m-auto d-block" src="/images/empty-cart.png" alt="empty-cart" style="width: 10rem;">
        <h2 class="mb-4 mt-3">Your Cart is <span class="fw-bold text-custom-color">Empty!</span></h2>
        <a href="/" class="btn custom-btn w-100">Return To Shop</a>
      </div>

  @else
  <div class="row">
  
    <div class="col-lg-auto">
      <h3>Cart</h3>
      <hr>
        @foreach ($products as $product)
          <div class="card mb-3" id="card" style="width: 50rem">
            <div class="row g-0">
              <div class="col-md-4">
                <a href="/product/{{ $product->slug }}">
                  <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="img-fluid rounded-start" alt="product-img">
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <a class="text-decoration-none text-dark" href="/product/{{ $product->slug }}"><h5 class="card-title">{{ Str::ucfirst($product->name) }}</h5></a>
                  <p class="card-text product-price currency fw-bold">{{ $product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price }}</p>
                

                  @if ($product->discount)
                    <div class="mb-3">
                    <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                    <small class="card-text currency text-decoration-line-through">{{ $product->price }}</small>
                    </div>
                  
                  @endif
                  
                  <div class="row mb-3">
                    <p class="d-inline col-sm-auto">Total Stock: </p>
                    <p class="stock d-inline col-sm-auto">{{ $product->stock }}</p>
                </div>
                <hr>
                <div class="row mt-3">
                  <div class="col-sm">
                    <p class="fw-bold">Subtotal</p>
                  </div>
                  <div class="col-sm-auto">
                    <p class="currency subtotal fw-bold">{{ $product->pivot->quantity * ($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price) }}</p>
                  </div>
                </div>

                  <div class="row mt-5">
                    <div class="col-sm-auto">
                      <div class="row mb-3 m-auto">
                        <div class="col-sm-auto">
                            <button class="btn custom-btn minus-cart-button" type="button"><i class="fa-solid fa-minus"></i></button>
                        </div>
                        <div class="col-sm-auto">
                            <input class="form-control" type="number" name="quantity" min="1" value="{{ $product->pivot->quantity }}" max="{{ $product->stock }}" id="quantity">
                            <input type="hidden" name="cart_id" value="{{ $product->pivot->id }}">
                          </div>
                        <div class="col-sm-auto">
                            <button class="btn custom-btn plus-cart-button" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>  
                    </div>

                    <div class="col-sm">
                      <button class="btn btn-danger float-end" type="button" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $product->name }}"><i class="fa-solid fa-trash"></i></button>
                    </div>
                    
                  </div>
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
                    <form action="/cart" method="POST">
                      @csrf
                      @method("delete")
                      <input type="hidden" name="selected_cart_id" value="{{ $product->pivot->id }}">
                      <div class="modal-body">
                        Are you sure delete this item from your cart?
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

    <div class="col-lg-auto">
        <div class="card" style="width: 22rem;">
            <div class="card-body">
              <h5 class="card-title">Shopping Summary</h5>
              <hr>
              <div class="row">
                <div class="col-lg">
                  <p class="card-text">Total Price ({{ $products->sum("pivot.quantity") }}) items</p>
                </div>

                <div class="col-lg-auto">
                  <p class="currency total-price">{{ auth()->user()->getTotalPrice() }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg">
                  <h5 class="fw-bold">Total Price</h5>
                </div>

                <div class="col-lg-auto">
                  <h5 class="currency total-price">{{ auth()->user()->getTotalPrice() }}</h5>
                </div>
              </div>

              <form action="" class="mt-3">
                <button class="btn custom-btn w-100" type="submit">Purchase ({{ $products->sum("pivot.quantity") }})</button>
              </form>
            </div>
          </div>
    </div>
</div>
  @endif
@endsection