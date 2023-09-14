@extends('layouts.main')

@section('title')
    Fashion Store - Home
@endsection

@section('content')

    @include('partials.carousel')

   <div class="mt-5 col-lg-2 col-md-2 ms-auto">
    <select class="form-select">
        <option selected>Sort By</option>
        <option value="1">Higher Price</option>
        <option value="2">Lower Price</option>
        <option value="3">Rating</option>
      </select>
   </div>

   
   <div class="row">
    <div class="col-lg mt-3 mb-3">
        <div class="card" style="width: 18rem;">
            <img src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920" class="card-img-top" alt="card-img">
            <div class="card-body">
              <h5 class="card-title">Pink T-Shirt</h5>
              <p class="card-text">Rp. 100.000</p>
              
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
       </div>
       
   </div>
@endsection