@extends('layouts.main')

@section('title')
    Account Setting
@endsection

@section('content')


@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

    <div class="row">
        <div class="col-sm-auto">
            <div class="border rounded p-3">
                <nav class="nav flex-column">
                    <a class="nav-link active" aria-current="page" href="/account-settings">Profile User</a>
                    <a class="nav-link" href="/account-settings/change-password">Change Password</a>
                  </nav>
            </div>
        </div>

        <div class="col-sm">
            <div class="border rounded p-3">
                <div class="mb-3 p-3">
                    <h5 class="fw-bold">Profile Picture</h5>
                    
                    <img class="img-fluid rounded-circle mt-3 m-auto d-block mb-4 profile-picture-preview border" src="/{{ auth()->user()->profile_picture ?? 'images/blank-profile-picture.png' }}" style="width: 30%">

                    <form action="/user" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")
                       <div class="row">
                        <div class="col-lg-auto mb-3">
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/*">
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-auto">
                            <button class="btn custom-btn" type="submit">Save changes</button>
                        </div>
                       </div>
                    </form>
                </div>

                <div class="mb-3 p-3">
                    <h5 class="fw-bold">Profile Information</h5>

                    <form action="/user" method="post" class="my-3">
                        @csrf
                        @method("patch")
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" disabled>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ auth()->user()->phone_number }}">
                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="btn custom-btn my-3" type="submit">Save changes</button>
                    </form>
                </div>

                <div class="mb-3 p-3">
                    <h5 class="fw-bold">Address Information</h5>

                    <form action="/user" method="post" class="my-3">
                        @csrf
                        @method("patch")
                        <div class="mb-3">
                            <label class="form-label">Address Street</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ auth()->user()->address }}">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-auto mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ auth()->user()->country }}">
                                @error('country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="col-sm-auto mb-3">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ auth()->user()->state }}">
                                @error('state')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="col-sm-auto mb-3">
                                <label class="form-label">ZIP Code</label>
                                <input type="text" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ auth()->user()->zip }}">
                                @error('zip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            
                        </div>

                        <button class="btn custom-btn my-3" type="submit">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection