@foreach ($comments as $comment)
    <div class="bg-white p-3 rounded mb-3" style="margin-left: {{ $marginLeft * 10 }}%">
        
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
        @include('partials.comment', ["comments" => $comment->reply, "parent_id" => $comment->id, "marginLeft" => $marginLeft+1])
    @endif
@endforeach