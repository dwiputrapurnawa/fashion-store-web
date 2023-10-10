@extends('layouts.dashboard')

@section('title')
    Products
@endsection

@section('content')

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="mb-3">
  <table class="table table-hover table-responsive">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Price (IDR)</th>
        <th scope="col">Description</th>
        <th scope="col">Category</th>
        <th scope="col">Published At</th>
        <th class="d-none">Slug</th>
        <th class="d-none">Product ID</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td>Rp.@money($product->price)</td>
            <td>{!! \Illuminate\Support\Str::limit($product->description, 150, $end='...') !!}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->created_at->format("d F Y") }}</td>
            <td class="d-none">{{ $product->slug }}</td>
            <td class="d-none">{{ $product->id }}</td>
          </tr>  
        @endforeach

    </tbody>
  </table>
</div>

@endsection