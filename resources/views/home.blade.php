@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("includes.message")
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Place a post!</h3></header>
            {!! Form::open(['route' => 'create.post']) !!}
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="New post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            {!! Form::close() !!}
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Other posts</h3></header>
            @foreach($posts as $post)
                <article class="post">
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a> |
                        <a href="#">Dislike</a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="#">Edit</a> |
                            <a href="{{ route('delete.post', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
