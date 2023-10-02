@foreach ($comments as $comment)
    <div class="bg-white p-3 rounded mb-3" style="margin-left: {{ $marginLeft * 10 }}%">
        <p>{{ $comment->user->name }}</p>
        <small class="text-body-secondary">{{ $comment->created_at->diffForHumans() }}</small>
        <p class="mt-3">{{ $comment->content }}</p>

        <form action="/comment" method="post" class="my-3 row">
            @csrf
            <div class="col-sm">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="content" style="height: 60px"></textarea>
                    <label for="comment">Comment</label>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                </div>
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