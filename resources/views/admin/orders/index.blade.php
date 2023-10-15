@extends('layouts.dashboard')

@section('title')
    Orders Data
@endsection

@section('content')

<div class="mb-3 border rounded p-3">
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
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">Detail Transaction</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="row mb-3 border border-start-0 border-end-0 p-3">
                            <div class="col-lg">
                                <p>Order Status</p>
                                <p>No. Invoice</p>
                                <p>Purchase Date</p>
                            </div>
                            <div class="col-lg">
                                <p class="text-capitalize fw-bold">{{ $order->order_status }}</p>
                                <p>{{ $order->invoice_number }}</p>
                                <p>{{ $order->created_at->format("d F Y") }}</p>
                            </div>
                        </div>

                        <div class="row mb-3 border border-start-0 border-end-0 p-3">
                            <p class="fw-bold">Product Detail</p>
                                @foreach ($order->products as $product)
                                <div class="row border mb-2 rounded">
                                    <div class="col-sm-auto">
                                        <img class="img-fluid img-thumbnail m-3" style="width: 100px"  src="/{{ $product->images[0]->path ?? "images/no-image.jpg" }}" alt="product-img">
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="m-3 fw-bold">{{ $product->name }}</h5>
                                        <p class="m-3">{{ $product->pivot->quantity }} items x <span>Rp. @money($product->pivot->price_per_unit)</span></p>
                                    </div>
                                    <div class="col-sm p-3">
                                        <p class="text-secondary">Total Price</p>
                                        <h5 class="fw-bold">Rp. @money($product->pivot->quantity * $product->pivot->price_per_unit)</h5>
                                    </div>
                                </div>
                                @endforeach
                        </div>

                        <div class="row mb-3 border border-start-0 border-end-0 p-3">
                            <p class="fw-bold">Shipping Info</p>
                            <div class="col-lg-auto">
                                <p>Courir</p>
                                <p>No. Tracking</p>
                                <p>Address</p>
                            </div>
                            <div class="col-lg">
                                <p>{{ $order->shipping->name }}</p>
                                <div class="mb-2">
                                    <p class="tracking-number d-inline">{{ $order->tracking_number }}</p>
                                    <button class="btn btn-sm clipboard-btn" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Copy the Tracking Number"><i class="fa-regular fa-clipboard"></i></button>
                                </div>
                                <p>{{ $order->address }}</p>
                            </div>
                        </div>


                        <div class="row mb-3 border border-start-0 border-end-0 p-3">
                            <p class="fw-bold">Payment Details</p>
                            <div class="col-lg">
                                <p>Payment Method</p>
                                <p>Shipping Cost</p>
                                <p>Discount</p>
                                <p class="fw-bold">Total Price</p>
                            </div>
                            <div class="col-lg">
                                <p>Kredit/Debit Card</p>
                                <p>Rp. @money($order->shipping_cost)</p>
                                <p>-Rp. @money($order->coupon->discount)</p>
                                <p class="fw-bold">Rp. @money($order->total_price)</p>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal" tabindex="-1" id="editModal{{ $order->id }}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit {{ $order->invoice_number }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/order" method="post">
                      @csrf
                      @method("PATCH")

                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label">Order Status</label>
                          <select class="form-select" name="order_status">
                            @if ($order->order_status == "waiting")
                              <option value="waiting" selected>Waiting</option>
                            @else
                            <option value="waiting">Waiting</option>
                            @endif
  
                            @if ($order->order_status == "processed")
                              <option value="processed" selected>Processed</option>
                            @else
                            <option value="processed">Processed</option>
                            @endif
  
                            @if ($order->order_status == "sent")
                              <option value="sent" selected>Sent</option>
                            @else
                            <option value="sent">Sent</option>
                            @endif
  
                          </select>
                        </div>
  
                        <div class="mb-3">
                          <label class="form-label">Tracking Number</label>
                          
                          @if ($order->order_status == "sent")
                          <input type="number" name="tracking_number" class="form-control" value="{{ $order->tracking_number ?? '' }}">
                          @else
                          <input type="number" name="tracking_number" class="form-control" disabled value="{{ $order->tracking_number ?? '' }}">
                          @endif

                        </div>

                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
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

@endsection