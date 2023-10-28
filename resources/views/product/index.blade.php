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
            <img class="img-fluid mb-2 img-view img-thumbnail" src="/{{ $product->images[0]->path ?? "images/no-image.jpg" }}">
            <div class="img-list">
                @foreach ($product->images as $image)
                <img class="img-fluid img-thumbnail mb-2 img-item" src="/{{ $image->path ?? "images/no-image.jpg" }}">
                @endforeach
            </div>
        </div>

        <div class="col-lg">
            <h5>{{ $product->name }}</h5>
            <div class="row">
                <p class="d-inline col-sm-auto">Sold {{ $product->orders->count() }}</p>
                <div class="d-inline col-sm-auto">
                    <i class="fa-solid fa-star" style="color: #ffc800;"></i> {{ round($product->getAvgRating(), 1) }}
                    <p class="d-inline">({{ $product->reviews->count() }} Rating)</p>
                </div>
                <p class="d-inline col-sm-auto">Discussion ({{ $product->comments->count() }})</p>
            </div>
            <h3 class="fw-bold product-price d-inline">Rp. @money($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price)</h3>

            @if ($product->discount)
                <div class="mb-3">
                <span class="badge text-bg-danger">{{ $product->discount->percentage }}%</span>
                <small class="card-text text-decoration-line-through">Rp. @money($product->price)</small>
                </div>
            @endif
            <hr>

            <p class="text-wrap">{!! $product->description !!}</p>
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
                            <h5 class="fw-bold subtotal">Rp. @money($product->discount ? $product->price - (($product->discount->percentage / 100) * $product->price) : $product->price)</h5>
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


    <div class="row mt-5">
        
        <div class="col-lg">
            <h5 class="fw-bold mb-3">Review ({{ $product->reviews->count() }})</h5>

            <div class="bg-light p-3">

                @if ($product->reviews->isEmpty())
                    <div class="p-3">
                        <h5>There are <span class="text-custom-color d-inline-block fw-bold">no reviews</span> for this product yet.</h5>
                    </div>
                @else
                    @foreach ($product->reviews as $review)
                    <div class="bg-white p-3 mb-3">
                        <h6>{{ $review->user->name }}</h6>
                        <div class="row mb-3">
                        <div class="col-sm-auto">
                            <small>{{ $review->created_at->diffForHumans() }}</small>
                        </div>

                        <div class="col-sm"> 

                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fa-solid fa-star" style="color: #ffc800;"></i>
                                @endfor

                                @for ($i = 0; $i < (5-$review->rating); $i++)
                                <i class="fa-regular fa-star" style="color: #ffc800;"></i>
                                @endfor
                            
                        </div>
                        </div>
                    
                        <p>{{ $review->content }}</p>
                    </div>
                    @endforeach
                @endif

                

                

            </div>

        </div>

        <div class="col-lg row mt-3 mb-3 m-auto">
            <h5 class="fw-bold">Discussion ({{ $product->comments->count() }})</h5>
    
            <p class="text-secondary">{{ $product->name }}</p>
    
            <div class="mb-3 write-question row">
                <div class="col-sm-auto p-2 m-auto">
                    <i class="fa-brands fa-rocketchat fa-xl"></i>
                </div>
                
                <div class="col-sm p-2">
                    <p class="m-auto">Any question? Discuss with sellers or other users</p>
                </div>
                <div class="col-sm-auto p-2">
                    <a class="btn custom-btn float-end m-auto" href="#comment">Write a Question</a>
                </div>
            </div>
    
            <div class="comment-container mb-3 bg-light p-3">
                
                @if ($product->comments->isEmpty())
                <div class="p-3">
                    <h5>There are <span class="text-custom-color d-inline-block fw-bold">no comments</span> for this product yet</h5>
                    <h5>Be the first comment.</h5>
                </div>
                @else
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
                @endif

                
    
            </div>
    
            <form action="/comment" method="post" class="my-3">
                @csrf
                <textarea class="form-control" placeholder="Leave a comment here..." id="comment" name="content" style="height: 30px"></textarea>
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="row float-end">
                    <div class="col-sm">
                        <button class="btn custom-btn-outline my-3" type="button" id="cancelComment" disabled>Cancel</button>
                    </div>
                    <div class="col-sm">
                        <button class="btn custom-btn my-3" type="submit">Comment</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>


@endsection