<div class="interaction">
    @if(Auth::user()->id != $song->user_id)
        {!! Form::open(array('route' => array('like', $song->id))) !!}
        <button type="submit" class="button">Like</button>
        {!! Form::close() !!}
        {!! Form::open(array('route' => array('dislike', $song->id))) !!}
        <button type="submit" class="button">Dislike</button>
        {!! Form::close() !!}
    @endif
    @if(Auth::user()->id == $song->user_id)
            {!! Form::open(array('route' => array('delete.song', $song->id))) !!}
            <button type="submit" class="button">Delete</button>
            {!! Form::close() !!}
    @endif
    <p>{{ DB::table('likes')->where('song_id', $song->id)->count() }} like(s) | {{ DB::table('dislikes')->where('song_id', $song->id)->count()}} dislike(s)</p>
</div>
