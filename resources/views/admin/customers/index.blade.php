@extends('layouts.dashboard')

@section('title')
    Customers Data
@endsection

@section('content')

@if (session()->has("message"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{ session("message") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="mb-3 border rounded p-3">
    <table class="table table-hover table-responsive" id="customer-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Address</th>
          <th class="d-none">User ID</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->address }}</td>
                <td class="d-none">{{ $user->id }}</td>

                <div class="modal" tabindex="-1" id="editUserModal{{ $user->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit {{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
              
                      <form action="/dashboard/customers" method="POST">
                        @csrf
                        @method("patch")
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" disabled value="{{ $user->email }}">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control">
                          </div>

                          <input type="hidden" name="user_id" value="{{ $user->id }}">
                          <input type="hidden" name="oldPassword" value="{{ $user->password }}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                      </form>
              
                      
                    </div>
                  </div>
                </div>


                <div class="modal" tabindex="-1" id="deleteUserModal{{ $user->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Delete {{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/customers" method="post">
                        @csrf
                        @method("delete")
                        <div class="modal-body">
                          <p>Are you sure?</p>
                          <input type="hidden" name="user_id" value="{{ $user->id }}">
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

  <div class="modal" tabindex="-1" id="addUserModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="/dashboard/customers" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control">
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