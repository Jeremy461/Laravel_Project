<div class="interaction">
    @if(Auth::user() != $post->user)
        {!! Form::open(array('route' => array('like', $post->id))) !!}
        <button type="submit" class="button">Like</button>
        {!! Form::close() !!}
        {!! Form::open(array('route' => array('dislike', $post->id))) !!}
        <button type="submit" class="button">Dislike</button>
        {!! Form::close() !!}
    @endif
    @if(Auth::user() == $post->user)
            {!! Form::open(array('route' => array('delete.post', $post->id))) !!}
            <button type="submit" class="button">Delete</button>
            {!! Form::close() !!}
    @endif
    <p>{{ DB::table('likes')->where('post_id', $post->id)->count() }} like(s)</p>
</div>
