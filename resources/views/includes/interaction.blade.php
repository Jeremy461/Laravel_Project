<div class="interaction">
    @if (Auth::user())

        @if(Auth::user()->id != $song->user_id)
            <div class="interaction">
                {!! Form::open(array('route' => array('like', $song->id))) !!}
                <button type="submit" class="button">Like</button>
                {!! Form::close() !!}
                {!! Form::open(array('route' => array('dislike', $song->id))) !!}
                <button type="submit" class="button">Dislike</button>
                {!! Form::close() !!}
            </div>
        @endif
        @if(Auth::user()->id == $song->user_id)
            {!! Form::open(array('route' => array('delete.song', $song->id))) !!}
            <button type="submit" class="button">Delete</button>
            {!! Form::close() !!}
        @endif
        <p>{{ DB::table('likes')->where('song_id', $song->id)->count() }} like(s) | {{ DB::table('dislikes')->where('song_id', $song->id)->count()}} dislike(s)</p>

            <section class="row posts">
                <div class="col-md-6 col-md-offset-3">
                    <header><h3>Comments:</h3></header>
                    @foreach($posts as $post)
                        @if($post->song_id == $song->id)
                        <article class="post">
                            <p>{{ $post->body }}</p>
                            <div class="info">
                                Posted by <a href="{{ route('getProfile', ['userid' => $post->user->id]) }}">{{ $post->user->name }}</a>
                            </div>
                        </article>
                        @endif
                    @endforeach
                </div>
            </section>
            @if($uploadCount > 0)
                @if(Auth::user()->id != $song->user_id)
                    <section class="row new-post">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::open(array('route' => array('create.post', $song->id))) !!}
                                <div class="form-group">
                                    <input type="text" name="body" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Place comment</button>
                                <input type="hidden" value="{{ Session::token() }}" name="_token">
                            {!! Form::close() !!}
                        </div>
                    </section>
                @endif
            @else
                <p>You have to upload at least 1 song to place comments!</p>
            @endif

    @else
        <p>You must be logged in to comment or like/dislike a song</p>
    @endif
</div>
