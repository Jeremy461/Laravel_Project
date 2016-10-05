@extends('layouts.app')

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>{{ $user->name }}</h3></header>
        </div>
    </section>
    @if (Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('profile.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
    @include("includes.message")
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>{{ $user->name }}'s posts</h3></header>
            @foreach($posts as $post)
                <article class="post">
                    @if($post->user->id == $user->id)
                    <p>{{ $post->body }}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ $post->created_at }}
                    </div>
                    <div class="interaction">
                        @if(Auth::user() != $post->user)
                            <a href="#">Like</a> |
                            <a href="#">Dislike</a>
                        @endif
                        @if(Auth::user() == $post->user)
                            <a href="#">Edit</a> |
                            <a href="{{ route('delete.post', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                    @endif
                </article>
            @endforeach
        </div>
    </section>
@endsection
