@extends('layouts.main')

@section('title')
    Fashion Store - Cart
@endsection

@section('content')

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cart</li>
  </ol>
</nav>


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
  
    <div class="col-lg">
        @foreach ($products as $product)
          <div class="card mb-3" id="card" style="width: 55rem">
            <div class="row g-0">
              <div class="col-md-4">
                <a href="/product/{{ $product->slug }}">
                  <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="img-fluid rounded-start" alt="product-img">
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <a class="text-decoration-none text-dark" href="/product/{{ $product->slug }}"><h5 class="card-title">{{ Str::ucfirst($product->name) }}</h5></a>
                  <p class="card-text product-price fw-bold">Rp. @money($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price)</p>
                

                  @if ($product->discount)
                    <div class="mb-3">
                    <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                    <small class="card-text text-decoration-line-through">Rp. @money($product->price)</small>
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
                    <p class="subtotal fw-bold">Rp. @money($product->pivot->quantity * ($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price))</p>
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
                  <p class="total-price-items">Rp. @money(auth()->user()->getTotalPrice())</p>
                </div>
              </div>

              <div class="row coupon-container d-none">
                <div class="col-lg">
                  <h6 class="coupon-code"></h6>
                </div>
                <div class="col-lg-auto">
                  <p class="d-inline">-<p class="d-inline coupon-discount"></p></p>
                </div>
              </div>

           
                  <div class="row">
                    <div class="col-lg">
                      <input type="text" class="form-control" name="coupon" id="couponCode" placeholder="Coupon Code">
                    </div>
                    <div class="col-lg-auto">
                      <button class="btn custom-btn reedem-btn" type="submit">Reedem</button>
                    </div>
                  </div>

              <hr>
              <div class="row">
                <div class="col-lg">
                  <h5 class="fw-bold">Total Price</h5>
                </div>

                <div class="col-lg-auto">
                  <h5 class="currency total-price fw-bold">0</h5>
                </div>
              </div>

              <div class="mt-3">
                <button class="btn custom-btn w-100" type="button" data-bs-toggle="modal" data-bs-target="#purchaseModal">Purchase ({{ $products->sum("pivot.quantity") }})</button>
              </div>

              <div class="modal fade" id="purchaseModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Checkout Items</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <div class="mb-3">

                       <div class="mb-3 border p-3 rounded">
                        <h5>Shipping address</h5>
                        <p>{{ auth()->user()->address }}</p>

                       </div>

                       <div class="mb-3 border p-3 rounded">
                        <h5>Shipping expedition</h5>
                        <select class="form-select" name="shipping" id="shipping">
                          @foreach ($shippings as $shipping)
                            <option value="{{ mt_rand(20000, 100000) }}">{{ $shipping->name }}</option>
                          @endforeach
                        </select>
                       </div>

                       <div class="mb-4 border p-3">
                        <h5>Payment</h5>
                        <p>Pay using credit cards</p>
                        <img class="img-fluid mb-3" width="80px" src="/images/mastercard-visa.png" alt="mastercard-visa">

                        <form action="">
                          <div class="mb-3">
                            <label for="credit-card" class="form-label">Credit Card</label>
                            <input class="form-control" type="text" name="creditCard" placeholder="4312 XXXX XXXX XXXX">
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="John Doe">
                          </div>

                          <div class="row">
                            <div class="col-lg mb-3">
                              <label for="exp-date" class="form-label">Expiration Date</label>
                              <input class="form-control" type="text" name="expDate" id="exp-date" placeholder="11/24">
                            </div>
                            <div class="col-lg mb-3">
                              <label for="cvv" class="form-label">CVV</label>
                              <input class="form-control" type="text" name="cvv" id="cvv">
                            </div>
                          </div>
                        </form>
                       </div>

                       @foreach ($products as $product)
                        <div class="mb-3 border p-3">
                          <div class="row">
                            <div class="col-lg-auto">
                              <img class="d-inline-block" style="width: 70px" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" alt="">
                            </div>

                            <div class="col-lg">
                              <h5>{{ $product->name }}</h5>
                              <div class="row">
                                <div class="col-lg">
                                  <h6 class="currency fw-bold">{{ $product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price }}</h6>
                                  @if ($product->discount)
                                      <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                                      <small class="card-text currency text-decoration-line-through">{{ $product->price }}</small>
                                  @endif

                                  
                                </div>
                                <div class="col-lg">
                                 <p class="text-end"> x {{ $product->pivot->quantity }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                       @endforeach


                       <div class="mb-3 title-background m-auto">

                       <div class="row">
                        <div class="col-lg">
                          <h6>Total Price ({{ $products->sum("pivot.quantity") }}) items</h6>
                        </div>
                        <div class="col-lg">
                          <p class="fw-bold currency total-price-items-checkout"></p>
                        </div>
                       </div>

                       <div class="row shipping-price-container d-none" >
                        <div class="col-lg">
                          <h6>Shipping</h6>
                        </div>
                        <div class="col-lg">
                          <p class="fw-bold currency shipping-price"></p>
                        </div>
                       </div>

                       <div class="row coupon-container d-none">
                        <div class="col-lg">
                          <h6>Discount Coupon</h6>
                        </div>
                        <div class="col-lg">
                          <p class="d-inline">-<p class="currency fw-bold d-inline coupon-discount-checkout"></p></p>
                        </div>
                       </div>

                        <div class="row">
                          <div class="col-lg">
                            <h5 class="fw-bold">Total</h5>
                          </div>
                          <div class="col-lg">
                            <p class="fw-bold currency total-price-checkout"></p>
                          </div>
                        </div>

                       </div>


                       

                      </div>

                    </div>
                    <div class="modal-footer">

                      <form action="/checkout" method="POST">
                        {{-- TODO CHECKOUT FORM --}}
                        
                        <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-btn" id="checkout-btn">Checkout</button>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
  @endif
@endsection