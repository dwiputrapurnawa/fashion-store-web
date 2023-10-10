@extends('layouts.dashboard')

@section('title')
    {{ $product->name }}
@endsection

@section('content')

<div class="mb-3 col-lg-8">
    <div class="row mb-3">
        <h5 class="mb-3 fw-bold">Edit Images</h5>
        @foreach ($product->images as $image)
        <div class="col-lg-auto mb-3">
            <img class="img-fluid img-thumbnail mb-2" style="width: 10rem; height: 15rem" src="/{{ $image->path }}" alt="preview-img">
            <form action="/images" method="post">
                @csrf
                @method("delete")
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <input type="hidden" name="image_path" value="{{ $image->path }}">
                <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}">Delete <i class="fa-solid fa-trash"></i></button>
                
                <div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5">Delete Image</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-dark">Yes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
            </form>
        </div>
        @endforeach
    </div>

     <form action="/images" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg">
                <input class="form-control @error('files.*') is-invalid @enderror" type="file" name="files[]" multiple accept="image/*">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @error('files.*')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-lg">
                <button class="btn btn-dark" type="submit">Upload</button>
            </div>
        </div>
        
    </form>

    <hr>
    
    <h5 class="mb-3 fw-bold">Edit Information</h5>
   <form action="/product" method="post" class="mb-5">
    @csrf
    @method("PUT")

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $product->name }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="row mb-3">
        <div class="col-lg">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ $product->price }}">
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="col-lg">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ $product->stock }}">
            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="col-lg">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                    @if ($product->category->name === $category->name)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
              </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="editor" class="form-label">Description</label>
        <textarea name="description" id="editor" cols="30" rows="10">{{ $product->description }}</textarea>
    </div>

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <button class="btn btn-dark" type="submit">Save changes</button>

    </form> 
</div>
@endsection