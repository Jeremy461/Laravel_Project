<div class="interaction">
    @if(Auth::user() != $post->user)
        <a href="{{ route('like', ['post_id' => $post->id]) }}">Like</a> |
        <a href="{{ route('dislike', ['post_id' => $post->id]) }}">Dislike |</a>
    @endif
    @if(Auth::user() == $post->user)
        <a href="#">Edit</a> |
        <a href="{{ route('delete.post', ['post_id' => $post->id]) }}">Delete</a>
    @endif
    <p>{{ $post->likes }} like(s)</p>
</div>
