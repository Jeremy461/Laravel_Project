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
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>{{ $user->name }}'s posts</h3></header>
            @foreach($songs as $song)
                @if($song->user_id == $user->id)
                <article class="post">
                    <p>Title: {{ $song->title }}</p>
                    <p>Genre: {{ $song->genre }}</p>
                    <audio controls>
                        <source src="{{ route('get.song', ['path' => $song->path]) }}" type="audio/mpeg">
                    </audio><br>
                    Posted by <a href="{{ route('getProfile', ['userid' => $song->user->id]) }}">{{ $song->user->name }}</a>
                    @include("includes.interaction")
                </article>
                @endif
            @endforeach
        </div>
    </section>
@endsection
