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
                    <img style="width: 100px" class="img-fluid mb-3 rounded-circle" src="/{{ auth()->user()->profile_picture ?? 'images/blank-profile-picture.png' }}" alt="user-account">
                </div>
                <div class="col-lg align-items-center d-flex">
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </div>

            <hr>

            <a class="btn custom-btn w-100" href="/account-settings">Account Setting</a>
        </div>
    </div>


    <div class="col-lg p-3">
        <h5 class="mb-3 fw-bold">Transaction List</h5>

        <div class="border p-3 rounded">

            @if ($orders->isEmpty())
                <div class="p-3">
                    <h5 class="fw-bold">There is no transaction</h5>
                </div>
            @else
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
                                @if ($order->order_status == "completed")
                                    <span class="badge rounded-pill text-bg-success text-capitalize">{{ $order->order_status }}</span>
                                @elseif($order->order_status == "canceled")
                                    <span class="badge rounded-pill text-bg-danger text-capitalize">{{ $order->order_status }}</span>
                                @else
                                    <span class="badge rounded-pill text-bg-warning text-capitalize">{{ $order->order_status }}</span>
                                @endif
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
                            @if ($order->order_status == "sent")
                                <button class="btn custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#completedOrder{{ $order->id }}">Complete the Order</button>
                            @elseif($order->order_status == "completed")
                                <button class="btn custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#reviewOrder{{ $order->id }}">Review</button>
                            @elseif($order->order_status == "waiting")
                                <button class="btn custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#cancelOrder{{ $order->id }}">Cancel Order</button>
                            @endif
                            
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="modal fade" id="completedOrder{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5">Complete the Order {{ $order->invoice_number }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure to complete the order?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">No</button>
                            
                            <form action="/order" method="post">
                                @csrf
                                @method("patch")
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="order_status" value="completed">
                                <button type="submit" class="btn custom-btn">Yes</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>


                    <div class="modal fade" id="cancelOrder{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5">Cancel the Order {{ $order->invoice_number }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure to cancel the order?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">No</button>
                            
                            <form action="/order" method="post">
                                @csrf
                                @method("patch")
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="order_status" value="canceled">
                                <button type="submit" class="btn custom-btn">Yes</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="modal fade" id="reviewOrder{{ $order->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5">Review Order {{ $order->invoice_number }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                            @foreach ($order->products as $product)
                            <div class="row mb-3 p-3 border">
                                <div class="col-sm-auto">
                                    <img style="width: 100px" src="/{{ $product->images[0]->path }}" alt="">
                                </div>
                                <div class="col-sm">
                                    <h5 class="fw-bold">{{ $product->name }}</h5>
                                    @if ($product->reviews->contains("user_id", auth()->user()->id))
                                        @foreach ($product->reviews->where("user_id", auth()->user()->id) as $review)
                                            <div class="bg-white mb-3">
                                                <h6>{{ $review->user->name }}</h6>
                                                <div class="row mb-3">
                                                <div class="col-sm-auto">
                                                    <small>{{ $review->created_at->diffForHumans() }}</small>
                                                </div>
                        
                                                <div class="col-sm"> 
                        
                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                            <i class="fa-solid fa-star" style="color: #ffc800;"></i>
                                                        @endfor
                        
                                                        @for ($i = 0; $i < (5-$review->rating); $i++)
                                                        <i class="fa-regular fa-star" style="color: #ffc800;"></i>
                                                        @endfor
                                                    
                                                </div>
                                                </div>
                                            
                                                <p>{{ $review->content }}</p>
                                            </div> 
                                        @endforeach

                                    @else
                                    <form action="/review" method="post">
                                        @csrf
                                        <div class="rating mb-3">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class="star" for="star1" title="Bad" aria-hidden="true"></label>

                                            <input type="hidden" name="rating" id="rating">
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <textarea class="form-control" name="review" id="review" cols="30" rows="10" placeholder="Your review..."></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn custom-btn" type="submit">Submit</button>
                                        </div>
                                    </form>
                                    @endif
                                   
                                </div>
                            </div>
                            @endforeach

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>

                @endforeach  
            @endif
        </div>
    </div>

</div>



@endsection