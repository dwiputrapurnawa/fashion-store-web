@extends('layouts.dashboard')

{{-- @section('title')
    Show {{ $product->name }}
@endsection --}}

@section('content')

    <div class="row border rounded mb-3">
        <div class="col-sm-auto mt-3">
            <a class="btn btn-dark text-decoration-none mb-3" href="/dashboard/products/{{ $product->slug }}/edit"><i class="fa-solid fa-pen-to-square"></i> Edit Product</a>
        </div>
        <div class="col-sm-auto mt-3">
            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#deleteProduct"><i class="fa-solid fa-trash"></i> Delete Product</button>
        </div>
    </div>

    <div class="row column-gap-3">
        <div class="col-lg p-3 border rounded mb-3">
            <h5 class="mb-3 fw-bold">Product Images</h5>
            <div class="row">
                @foreach ($product->images as $image)
                   <div class="col-sm-auto mb-3">
                        <img class="img-fluid img-thumbnail highlight" style="width: 200px" src="/{{ $image->path }}" alt="product-images">
                   </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg p-3 border rounded mb-3">
            <h5 class="mb-3 fw-bold">Product Information</h5>
            <table class="table table-striped-columns">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td class="text-capitalize">{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td>Slug</td>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>Rp.@money($product->price)</td>
                    </tr>
                    <tr>
                        <td>Stock</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>{{ $product->weight }} Kg</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td>{{ $product->getAvgRating() ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td>Comment</td>
                        <td>{{ $product->comments->count() }}</td>
                    </tr>
                    <tr>
                        <td>Review</td>
                        <td>{{ $product->reviews->count() }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>


    <div class="modal" tabindex="-1" id="deleteProduct">
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

    
@endsection