@extends('layouts.main')

@section('title')
    {{ $product->name }}
@endsection

@section('content')
    <div class="row">

        @if (session()->has("message"))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session("message") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">{{ Str::ucfirst($product->category->name) }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($product->name) }}</li>
            </ol>
          </nav>

        <div class="col-lg">
            <img class="img-fluid mb-2 img-view img-thumbnail" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            <div class="img-list">
                <img class="img-fluid img-thumbnail mb-2 img-item" src="https://storage.sg.content-cdn.io/cdn-cgi/image/%7Bwidth%7D,%7Bheight%7D,quality=75,format=auto/in-resources/ff5c6da1-2d74-4846-96c9-ccd65d766244/Images/ProductImages/Source/Levis-Mens-Relaxed-Fit-Graphic-Zip-Up-Hoodie-387170020_01_Front.jpg">
                <img class="img-fluid img-thumbnail mb-2 img-item" src="https://www.diadora.com/dw/image/v2/BBPK_PRD/on/demandware.static/-/Sites-diadora-master/default/dw250e8493/images/hi-res/502.180038_50025_00_HR.jpg?sw=1920">
            </div>
        </div>

        <div class="col-lg">
            <h5 class="fw-bold">{{ $product->name }}</h5>
            <div class="row">
                <p class="d-inline col-sm-auto">Sold 100+</p>
                <div class="d-inline col-sm-auto">
                    <i class="fa-solid fa-star" style="color: yellow;"></i> {{ round($product->getAvgRating(), 1) }}
                    <p class="d-inline">({{ $product->user_rating->count() }} rating)</p>
                </div>
                <p class="d-inline col-sm-auto">Discussion (14)</p>
            </div>
            <h3 class="fw-bold product-price currency d-inline">{{ $product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price }}</h3>

            @if ($product->discount)
                <div class="mb-3">
                <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                <small class="card-text currency text-decoration-line-through">{{ $product->price }}</small>
                </div>
            @endif
            <hr>

            <p class="text-wrap">{{ $product->description }}</p>
        </div>
        
        <div class="col">

            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h5 class="card-title mb-3 text-center">Set Amount</h5>
                  <form action="/cart" method="POST" class="p-2">
                    @csrf
                    <div class="row mb-3 m-auto">
                        <div class="col-sm-auto m-auto">
                            <button class="btn custom-btn minus-button" type="button"><i class="fa-solid fa-minus"></i></button>
                        </div>
                        <div class="col-sm-auto m-auto">
                            <input class="form-control" type="number" name="quantity" min="1" value="1" max="{{ $product->stock }}" id="quantity">
                        </div>
                        <div class="col-sm-auto m-auto">
                            <button class="btn custom-btn plus-button" type="button"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>
                    <div class="mb-3">
                        <p class="d-inline">Total Stock: </p>
                        <p class="stock d-inline">{{ $product->stock }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-auto">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-sm-auto">
                            <h5 class="fw-bold subtotal currency">{{ $product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price }}</h5>
                        </div>
                    </div>
                    <button class="btn custom-btn w-100" type="submit">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                  </form>
                  
                  @auth
                    @if (auth()->user()->wishlist->contains("id", $product->id))
                        <form action="/wishlist" method="POST" class="p-2">
                            @method("delete")
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn custom-btn-outline w-100" type="submit">Wishlist <i class="fa-solid fa-heart"></i></button>
                        </form>
                    @else
                        <form action="/wishlist" method="POST" class="p-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn custom-btn-outline w-100" type="submit">Wishlist <i class="fa-regular fa-heart"></i></button>
                        </form>
                    @endif
                  @else
                    <form action="/wishlist" method="POST" class="p-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn custom-btn-outline w-100" type="submit">Wishlist <i class="fa-regular fa-heart"></i></button>
                    </form>
                  @endauth
                
                  
                  
                </div>
              </div>

        </div>

    </div>

    <hr>

    <div class="row">
        
        <div class="col-lg">
            <h5 class="fw-bold">Review (13)</h5>
        </div>

        <div class="col-lg row mt-3 mb-3 m-auto">
            <h5 class="fw-bold">Discussion (13)</h5>
    
            <p class="text-secondary">{{ $product->name }}</p>
    
            <div class="mb-3 write-question row">
                <div class="col-sm-auto p-2">
                    <i class="fa-brands fa-rocketchat fa-xl"></i>
                </div>
                
                <div class="col-sm p-2">
                    <p>Ada pertanyaan? Diskusikan dengan penjual atau pengguna lain</p>
                </div>
                <div class="col-sm-auto p-2">
                    <a class="btn custom-btn float-end" href="#comment">Tulis Pertanyaan</a>
                </div>
            </div>
    
            <div class="comment-container mb-3 bg-light p-3">
                
                @foreach ($product->comments->filter(fn($item) => $item->parent_id === 0 ) as $comment)
                <div class="bg-white p-3 rounded mb-3">
                    
                    <div class="row">
                        <div class="col-lg">
                            <p>{{ $comment->user->name }}</p>
                        </div>

                        @auth
                            @if (auth()->user()->email === $comment->user->email)
                            <div class="col-lg">
                                <div class="dropdown">
                                    <button class="btn float-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" style="color: #8F5E2E"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $comment->id }}">Delete</button>
                                    </ul>
                                  </div>
    
    
                                  <div class="modal fade" id="deleteModal{{ $comment->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Comment</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/comment" method="post">
                                            @csrf
                                            @method("delete")
                                            <div class="modal-body">
                                                <p>Are you sure ?</p>
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn custom-btn-outline" data-bs-dismiss="modal">No</button>
                                                <button type="submit" class="btn custom-btn">Yes</button>
                                              </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
    
                            </div>
                            @endif
                        @endauth


                    </div>

                    

                    <small class="text-body-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                    <p class="mt-3">{{ $comment->content }}</p>

                    <hr>

                    <form action="/comment" method="post" class="my-3 row">
                        @csrf
                        <div class="col-sm m-auto">
                            <textarea class="form-control" placeholder="Leave a comment here..." name="content" style="height: 30px"></textarea>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        </div>
                        <div class="col-sm-auto">
                            <button class="btn custom-btn my-3" type="submit">Comment</button>
                        </div>
                    </form>
                </div>

                    @if (!$comment->reply->isEmpty())
                        @include('partials.comment', ["comments" => $comment->reply, "parent_id" => $comment->id, "marginLeft" => 1])
                    @endif

                @endforeach

                
    
            </div>
    
            <form action="/comment" method="post" class="my-3">
                @csrf
                    <textarea class="form-control" placeholder="Leave a comment here..." id="comment" name="content" style="height: 30px"></textarea>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn custom-btn my-3 float-end" type="submit">Comment</button>
            </form>
        </div>
    </div>


@endsection