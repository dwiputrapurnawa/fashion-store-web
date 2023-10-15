@extends('layouts.dashboard')

@section('title')
    {{ $product->name }}
@endsection

@section('content')

<div class="mb-3 col-lg-8">
    
    <div class="border rounded p-3 mb-3">
        <div class="row mb-3">
            <h5 class="mb-3 fw-bold">Edit Images</h5>
            @foreach ($product->images as $image)
            <div class="col-lg-auto mb-3 highlight position-relative">
                <img class="img-fluid mb-2" style="width: 13rem; height: 15rem" src="/{{ $image->path }}" alt="preview-img">
                <form action="/images" method="post">
                    @csrf
                    @method("delete")
                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                    <input type="hidden" name="image_path" value="{{ $image->path }}">
                    <button class="btn btn-sm position-absolute top-0 right-0" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}"><i class="fa-solid fa-x"></i></button>
                </form>
            </div>
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
            @endforeach
        </div>
    
         <form action="/images" method="post" enctype="multipart/form-data" class="mb-3">
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
                    <button class="btn btn-dark" type="submit"><i class="fa-solid fa-upload"></i> Upload</button>
                </div>
            </div>
            
        </form>
    </div>

    
   <form action="/product" method="post" class="mb-5 border p-3 rounded">
    @csrf
    @method("PUT")

    <h5 class="mb-3 fw-bold">Edit Information</h5>

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
            <label for="price" class="form-label">Price (IDR)</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-rupiah-sign"></i></span>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ $product->price }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
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
            <label for="weight" class="form-label">Weight (Gram)</label>
            <div class="input-group">
                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" value="{{ $product->weight }}">
                <span class="input-group-text"><i class="fa-solid fa-weight-hanging"></i></span>
                @error('weight')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-lg">
            <label for="category" class="form-label">Category</label>
            <div class="input-group">
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        @if ($product->category->name === $category->name)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                  </select>
                  <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#categoryModal">+</button>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="editor" class="form-label">Description</label>
        <textarea name="description" id="editor" style="border: none">{{ $product->description }}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <button class="btn btn-dark" type="submit">Save changes</button>

    </form> 
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/categories" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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