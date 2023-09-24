@extends('layouts.main')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="row">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">{{ Str::ucfirst($product->category->name) }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($product->name) }}</li>
            </ol>
          </nav>

        <div class="col">
            <img class="img-fluid mb-2 img-view" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            <div class="img-list">
                <img class="img-fluid mb-2 img-item" src="https://storage.sg.content-cdn.io/cdn-cgi/image/%7Bwidth%7D,%7Bheight%7D,quality=75,format=auto/in-resources/ff5c6da1-2d74-4846-96c9-ccd65d766244/Images/ProductImages/Source/Levis-Mens-Relaxed-Fit-Graphic-Zip-Up-Hoodie-387170020_01_Front.jpg">
                <img class="img-fluid mb-2 img-item" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
                <img class="img-fluid mb-2 img-item" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
                <img class="img-fluid mb-2 img-item" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            </div>
        </div>

        <div class="col">
            <h5 class="fw-bold">{{ $product->name }}</h5>
            <div class="row">
                <p class="d-inline col-sm-auto">Sold 100+</p>
                <div class="d-inline col-sm-auto">
                    <i class="fa-solid fa-star" style="color: yellow;"></i> 5
                    <p class="d-inline">(200 rating)</p>
                </div>
                <p class="d-inline col-sm-auto">Review (14)</p>
            </div>
            <h3 class="fw-bold d-inline">Rp.</h3>
            <h3 class="fw-bold product-price d-inline">{{ $product->price }}</h3>
            <hr>

            <p>{{ $product->description }}</p>
        </div>
        
        <div class="col">

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title mb-3">Set Amount</h5>
                  <form action="" method="POST" class="p-2">
                    <div class="mb-3">
                        <input class="form-control" type="number" name="total" min="1" id="total">
                    </div>
                    <div class="mb-3">
                        <p>Stock Total: 20</p>
                    </div>

                    <div class="row">
                        <div class="col-sm-auto">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-sm-auto">
                            <h5 class="fw-bold subtotal">Rp. 100.000</h5>
                        </div>
                    </div>
                    <button class="btn custom-btn w-100" type="submit">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                  </form>
                
                  <form action="" class="p-2">
                    <button class="btn custom-btn-outline w-100" type="submit">Wishlist <i class="fa-regular fa-heart"></i></button>
                  </form>
                  
                </div>
              </div>

        </div>

    </div>

    {{-- <div class="row mt-3 mb-3">
        <h5 class="fw-bold">Customer Review</h5>
    </div> --}}
@endsection