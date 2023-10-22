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
        <h5 class="mb-3 fw-bold">Transaction List</h5>

        <div class="border p-3 rounded">
            
            @foreach ($orders as $order)
                
            <a data-bs-toggle="modal" data-bs-target="#detailTransaction{{ $order->id }}">
                <div class="card w-100 mb-4 product-item">
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
                            <span class="badge rounded-pill text-bg-warning text-capitalize">{{ $order->order_status }}</span>
                        </div>
                        <div class="col-lg-auto">
                            <p>{{ $order->invoice_number }}</p>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <img class="img-fluid img-thumbnail m-3" style="width: 100px"  src="/{{ $order->products[0]->images[0]->path ?? "images/no-image.jpg" }}" alt="product-img">
                                </div>
                                <div class="col-lg">
                                    <h5 class="m-3 fw-bold">{{ $order->products[0]->name }}</h5>
                                    <p class="m-3">{{ $order->products[0]->pivot->quantity }} items x <span>Rp. @money($order->products[0]->pivot->price_per_unit)</span></p>
                                    @if ($order->products->count() > 1)
                                        <p class="m-3">+ {{ $order->products->count() - 1 }} more products</p>
                                    @endif
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-lg-auto p-3">
                            <p class="text-secondary">Total Price</p>
                            <h5 class="fw-bold">Rp. @money($order->total_price)</h5>
                        </div>
                      </div>
    
                    </div>
                  </div>
                </a>

                <div class="modal fade" id="detailTransaction{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Detail Transaction</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-3">
                            <div class="row mb-3 border border-start-0 border-end-0 p-3">
                                <div class="col-lg">
                                    <p>Order Status</p>
                                    <p>No. Invoice</p>
                                    <p>Purchase Date</p>
                                </div>
                                <div class="col-lg">
                                    <p class="text-capitalize fw-bold">{{ $order->order_status }}</p>
                                    <p>{{ $order->invoice_number }}</p>
                                    <p>{{ $order->created_at->format("d F Y") }}</p>
                                </div>
                            </div>

                            <div class="row mb-3 border border-start-0 border-end-0 p-3">
                                <p class="fw-bold">Product Detail</p>
                                    @foreach ($order->products as $product)
                                    <div class="row border mb-2 rounded">
                                        <div class="col-sm-auto">
                                            <img class="img-fluid img-thumbnail m-3" style="width: 100px"  src="/{{ $product->images[0]->path ?? "images/no-image.jpg" }}" alt="product-img">
                                        </div>
                                        <div class="col-sm">
                                            <h5 class="m-3 fw-bold">{{ $product->name }}</h5>
                                            <p class="m-3">{{ $product->pivot->quantity }} items x <span>Rp. @money($product->pivot->price_per_unit)</span></p>
                                        </div>
                                        <div class="col-sm p-3">
                                            <p class="text-secondary">Total Price</p>
                                            <h5 class="fw-bold">Rp. @money($product->pivot->quantity * $product->pivot->price_per_unit)</h5>
                                        </div>
                                    </div>
                                    @endforeach
                            </div>

                            <div class="row mb-3 border border-start-0 border-end-0 p-3">
                                <p class="fw-bold">Shipping Info</p>
                                <div class="col-lg-auto">
                                    <p>Courir</p>
                                    <p>No. Tracking</p>
                                    <p>Address</p>
                                </div>
                                <div class="col-lg">
                                    <p>{{ $order->shipping->name }}</p>
                                    <div class="mb-2">
                                        <p class="tracking-number d-inline">{{ $order->tracking_number }}</p>
                                        @if ($order->tracking_number)
                                            <button class="btn btn-sm clipboard-btn" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy the Tracking Number"><i class="fa-regular fa-clipboard"></i></button>
                                        @else
                                            -
                                        @endif
                                    </div>
                                    <p>{{ $order->address }}</p>
                                </div>
                            </div>


                            <div class="row mb-3 border border-start-0 border-end-0 p-3">
                                <p class="fw-bold">Payment Details</p>
                                <div class="col-lg">
                                    <p>Payment Method</p>
                                    <p>Shipping Cost</p>
                                    <p>Discount</p>
                                    <p class="fw-bold">Total Price</p>
                                </div>
                                <div class="col-lg">
                                    <p>Kredit/Debit Card</p>
                                    <p>Rp. @money($order->shipping_cost)</p>
                                    @if ($order->coupon)
                                        <p>-Rp. @money($order->coupon->discount)</p>
                                    @else
                                        <p>-</p>
                                    @endif
                                    <p class="fw-bold">Rp. @money($order->total_price)</p>
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