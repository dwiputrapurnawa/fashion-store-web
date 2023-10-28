@extends('layouts.main')

@section('title')
    Account Setting - Change Password
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
                    <h5 class="fw-bold">Change Password</h5>

                    <form action="/user" method="post" class="my-3">
                        @csrf
                        @method("patch")
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control">
                        </div>

                        <button class="btn custom-btn my-3 password-btn" type="submit" disabled>Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection