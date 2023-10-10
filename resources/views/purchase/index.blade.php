@extends('layouts.main')

@section('title')
    Fashion Store - Purchase
@endsection

@section('content')

<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Purchase</li>
    </ol>
  </nav>

<div class="row">
    
    <div class="col-lg-4">
        <div class="border rounded p-3">
            <div class="row">
                <div class="col-lg-auto">
                    <img style="width: 100px" class="img-fluid mb-3 rounded-circle" src="{{ auth()->user()->profile_picture }}" alt="user-account">
                </div>
                <div class="col-lg align-items-center d-flex">
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </div>

            <hr>

            <a class="btn custom-btn w-100" href="/settings">Account Setting</a>
        </div>
    </div>


    <div class="col-lg p-3">
        <h5 class="mb-3">Transaction List</h5>

        <div class="border p-3 rounded">
            
            @foreach ($orders as $order)
                @foreach ($order->products as $product)
                <div class="card w-100 mb-4">
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-lg-auto">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div class="col-lg-auto">
                            <p>Shopping</p>
                        </div>
                        <div class="col-lg-auto">
                            <p>{{ $order->created_at->format("d F Y") }}</p>
                        </div>
                        <div class="col-lg-auto">
                            <span class="badge rounded-pill text-bg-warning">Waiting</span>
                        </div>
                        <div class="col-lg-auto">
                            <p>INV/{{ $order->invoice_number }}</p>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <img class="img-fluid img-thumbnail m-3" style="width: 100px"  src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" alt="product-img">
                                </div>
                                <div class="col-lg">
                                    <h5 class="m-3 fw-bold">{{ $product->name }}</h5>
                                    <p class="m-3">{{ $product->pivot->quantity }} items x <span class="currency">{{ $product->pivot->price_per_unit }}</span></p>
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-lg-auto p-3">
                            <p class="text-secondary">Total Price</p>
                            <h5 class="fw-bold currency">{{ $product->pivot->quantity * $product->pivot->price_per_unit }}</h5>
                            <button class="btn custom-btn mt-2" type="button" data-bs-toggle="modal" data-bs-target="#detailTransaction{{ $order->id }}">Detail Transaction</button>
                        </div>
                      </div>
    
                    </div>
                  </div>
                @endforeach

                <div class="modal fade" id="detailTransaction{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Transaction</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3 border rounded">
                                <div class="title-background">
                                    <h5>Status</h5>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Invoice</p>
                                    </div>
                                    <div class="col-lg">
                                        <p>INV/{{ $order->invoice_number }}</p>
                                    </div>
                                </div>
        
                                  <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Order Status</p>
                                    </div>
                                    <div class="col-lg">
                                        <p>{{ Str::ucfirst($order->order_status) }}</p>
                                    </div>
                                  </div>
        
                            </div>

                            <div class="mb-3 border rounded">
                                <div class="title-background">
                                    <h5>Shipping</h5>
                                </div>

                                <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Tracking Number</p>
                                    </div>
                                    <div class="col-lg">
                                        <p>{{ $order->tracking_number }}</p>
                                    </div>
                                  </div>
                                  <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Shipping</p>
                                    </div>
                                    <div class="col-lg">
                                        <p>{{ $order->shipping->name }}</p>
                                    </div>
                                  </div>
        
                                  <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Shipping Cost</p>
                                    </div>
                                    <div class="col-lg">
                                        <p class="currency">{{ $order->shipping_cost }}</p>
                                    </div>
                                  </div>
                            </div>

                            <div class="mb-3 border rounded">
                                <div class="title-background">
                                    <h5>Purchase Items</h5>
                                </div>

                                @foreach ($order->products as $product)
                                    <div class="row m-3">
                                        <div class="col-lg">
                                            <p>{{ $product->name }}</p>
                                        </div>
                                        <div class="col-lg">
                                            <p>{{ $product->pivot->quantity }}</p>
                                        </div>
                                        <div class="col-lg">
                                            <p class="currency">{{ $product->pivot->price_per_unit }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3 border rounded">
                                <div class="title-background">
                                    <h5>Summary</h5>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Total Price ({{ $order->products->count() }}) items</p>
                                    </div>
                                    <div class="col lg">
                                        <p class="currency">{{ $order->getTotalPriceitem() }}</p>
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Coupon Discount</p>
                                    </div>
                                    <div class="col lg">
                                        <p class="d-inline">-<p class="currency d-inline">{{ $order->coupon->discount }}</p></p>
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg">
                                        <p>Shipping</p>
                                    </div>
                                    <div class="col lg">
                                        <p class="currency">{{ $order->shipping_cost }}</p>
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg">
                                        <h5 class="fw-bolf">Total Price</h5>
                                    </div>
                                    <div class="col-lg">
                                        <h5 class="currency fw-bold">{{ $order->total_price }}</h5>
                                    </div>
                                  </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

            @endforeach

        </div>
    </div>

</div>

@endsection