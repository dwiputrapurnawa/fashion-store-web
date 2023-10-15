@extends('layouts.dashboard')

@section('title')
    Products Data
@endsection

@section('content')

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="mb-3 border p-3 rounded">
  <table class="table table-hover table-responsive" id="product-table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price (IDR)</th>
        <th scope="col">Description</th>
        <th scope="col">Weight (Kg)</th>
        <th scope="col">Category</th>
        <th scope="col">Discount (%)</th>
        <th scope="col">Rating</th>
        <th scope="col">Comment</th>
        <th scope="col">Review</th>
        <th scope="col">Created At</th>
        <th class="d-none">Slug</th>
        <th class="d-none">Product ID</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td><img class="img-fluid" src="/{{ $product->images[0]->path ?? 'images/no-image.jpg' }}" alt="product-img"></td>
            <td>{{ $product->name }}</td>
            <td>Rp.@money($product->price)</td>
            <td class="text-justify">{!! \Illuminate\Support\Str::limit($product->description, 20, $end='...') !!}</td>
            <td>{{ $product->weight / 1000 }} Kg</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->discount->percentage ?? 0 }}%</td>
            <td>{{ $product->getAvgRating() ?? 0 }}</td>
            <td>{{ $product->comments->count() }}</td>
            <td>{{ $product->reviews->count() }}</td>
            <td>{{ $product->created_at->format("d F Y") }}</td>
            <td class="d-none">{{ $product->slug }}</td>
            <td class="d-none">{{ $product->id }}</td>

            <div class="modal" tabindex="-1" id="deleteProductModal{{ $product->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Delete {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/product" method="post">
                    @csrf
                    @method("delete")
                    <div class="modal-body">
                      <p>Are you sure?</p>
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-dark">Yes</button>
                    </div>
                  </form>
                  
                 
                </div>
              </div>
            </div>
          </tr>  
        @endforeach

    </tbody>
  </table>
</div>



<div class="modal" tabindex="-1" id="discountModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/discount" method="post">
        @csrf
        <div class="modal-body">
          <label class="form-label">Discount (%)</label>
          <div class="input-group">
            <input class="form-control" type="number" name="discount">
            <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
          </div>
          <input type="hidden" name="productIds[]">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Save changes</button>
        </div>
      </form>
      
      
    </div>
  </div>
</div>

@endsection