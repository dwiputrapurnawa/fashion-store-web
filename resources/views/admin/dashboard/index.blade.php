@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="mb-3">

    <div class="row">

        <div class="col-sm-auto">
            <div class="row p-3">
                <div class="col-sm-auto border rounded text-center" style="height: 160px">
                    <div class="row mx-auto my-2">
                        <div class="col-sm-auto border rounded bg-dark" style="width: 20px"></div>
                        <div class="col-sm-auto">
                            <p class="d-inline">Total Revenue</p>
                        </div>
                        <div class="col-sm p-1">
                            <i class="fa-solid fa-ellipsis-vertical float-end"></i>
                        </div>
                    </div>
                    <div class="mb-3 p-3">
                        <h2>Rp.@money($orders->sum("total_price"))</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-auto">
            <div class="row p-3">
                <div class="col-sm-auto border rounded text-center" style="height: 160px">
                    <div class="row mx-auto my-2">
                        <div class="col-sm-auto border rounded bg-dark" style="width: 20px"></div>
                        <div class="col-sm-auto">
                            <p class="d-inline">Total Product</p>
                        </div>
                        <div class="col-sm p-1">
                            <i class="fa-solid fa-ellipsis-vertical float-end"></i>
                        </div>
                    </div>
                    <div class="mb-3 p-3">
                        <h2>{{ $products->count() }}</h2><small>items</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-auto">
            <div class="row p-3">
                <div class="col-sm-auto border rounded text-center" style="height: 160px">
                    <div class="row mx-auto my-2">
                        <div class="col-sm-auto border rounded bg-dark" style="width: 20px"></div>
                        <div class="col-sm-auto">
                            <p class="d-inline">Total Order</p>
                        </div>
                        <div class="col-sm p-1">
                            <i class="fa-solid fa-ellipsis-vertical float-end"></i>
                        </div>
                    </div>
                    <div class="mb-3 p-3">
                        <h2>{{ $orders->count() }}</h2><small>orders</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-auto">
            <div class="row p-3">
                <div class="col-sm-auto border rounded text-center" style="height: 160px">
                    <div class="row mx-auto my-2">
                        <div class="col-sm-auto border rounded bg-dark" style="width: 20px"></div>
                        <div class="col-sm-auto">
                            <p class="d-inline">Total Customer</p>
                        </div>
                        <div class="col-sm p-1">
                            <i class="fa-solid fa-ellipsis-vertical float-end"></i>
                        </div>
                    </div>
                    <div class="mb-3 p-3">
                        <h2>{{ $users->count() }}</h2><small>users</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row gap-2">
        <div class="col-lg-5 border rounded p-3 mb-3">
            {!! $chartMonthlyRevenue->container() !!}
        </div>
        <div class="col-lg-5 border rounded p-3 mb-3">
            {!! $chartMonthlyOrder->container() !!}
        </div>
    </div>

    

</div>
{!! $chartMonthlyOrder->script() !!}
{!! $chartMonthlyRevenue->script() !!}
@endsection