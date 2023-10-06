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
                    <img style="width: 100px" class="img-fluid mb-3" src="https://static.vecteezy.com/system/resources/previews/019/896/008/original/male-user-avatar-icon-in-flat-design-style-person-signs-illustration-png.png" alt="user-account">
                </div>
                <div class="col-lg align-items-center d-flex">
                    <p>{{ auth()->user()->name }}</p>
                </div>
            </div>

            <hr>

            <a class="btn custom-btn w-100" href="/settings">Account Setting</a>

            {{-- <div class="row">
                <div class="col-lg">
                    
                    <div class="row">
                        <div class="col-lg-auto">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <div class="col-lg">
                            Saldo
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-auto">
                    Rp.100.000
                </div>
            </div> --}}
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
                            Shopping
                        </div>
                        <div class="col-lg-auto">
                            {{ $order->created_at->format("d F Y") }}
                        </div>
                        <div class="col-lg-auto">
                            <span class="badge rounded-pill text-bg-warning">Waiting</span>
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
                                    <p class="m-3">{{ $product->pivot->quantity }} items x <span class="currency">{{ $product->pivot->price }}</span></p>
                                </div>
                            </div>
                        </div>
    
    
                        <div class="col-lg-auto p-3">
                            <p class="text-secondary">Total Price</p>
                            <h5 class="fw-bold currency">{{ $product->pivot->quantity * $product->pivot->price }}</h5>
                        </div>
                      </div>
    
                    </div>
                  </div>
                @endforeach
            @endforeach

        </div>
    </div>

</div>

@endsection