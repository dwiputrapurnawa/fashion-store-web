@extends('layouts.dashboard')

@section('title')
    Add New Product
@endsection

@section('content')

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="row mb-3" id="preview-img-container">
</div>

<div class="mb-3 col-lg-8">
   <form action="/product" method="post" class="mb-5" enctype="multipart/form-data">
    @csrf


    <div class="mb-3">
        <label class="form-label">Upload Images</label>
        <input type="file" name="files[]" class="form-control @error('files.*') is-invalid @enderror" id="uploadImages" multiple>
        @error('files.*')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>



    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="row mb-3">
        <div class="col-lg">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="col-lg">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock">
            @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="col-lg">
            <label for="category" class="form-label">Category</label>
            <div class="input-group">
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#categoryModal">+</button>
            </div> 
        </div>
    </div>

    <div class="mb-3">
        <label for="editor" class="form-label">Description</label>
        <textarea name="description" id="editor" cols="30" rows="10"></textarea>
    </div>

    <button class="btn btn-dark" type="submit">Save Product</button>

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