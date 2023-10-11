@extends('layouts.dashboard')

@section('title')
    Orders
@endsection

@section('content')

<div class="mb-3">
    <table class="table table-hover table-responsive" id="order-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Invoice Number</th>
          <th scope="col">Customer</th>
          <th scope="col">Coupon</th>
          <th scope="col">Shipping</th>
          <th scope="col">Total Price</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Order Status</th>
          <th scope="col">Tracking Number</th>
          <th scope="col">Shipping Cost</th>
          <th scope="col">Address</th>
          <th class="d-none">Order ID</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($orders as $order)
          <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $order->invoice_number }}</td>
              <td>{{ $order->user->name }}</td>
              <td>{{ $order->coupon->code }}</td>
              <td>{{ $order->shipping->name }}</td>
              <td>Rp.@money($order->total_price)</td>
              <td>{{ Str::ucfirst($order->payment_status) }}</td>
              <td>{{ Str::ucfirst($order->order_status) }}</td>
              <td>{{ $order->tracking_number }}</td>
              <td>Rp.@money($order->shipping_cost)</td>
              <td>{{ $order->address }}</td>
              <td class="d-none">{{ $order->id }}</td>

              <div class="modal" tabindex="-1" id="detailOrder{{ $order->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Detail Order {{ $order->invoice_number }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-dark">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
          @endforeach
  
      </tbody>
    </table>
  </div>

@endsection