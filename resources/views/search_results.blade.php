@extends('layouts.app')

@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Search results</h3></header>
            @if($result_type == 'user')
                @foreach($results as $user)
                    <article class="post">
                        <div class="info">
                            <a href="{{ route('getProfile', ['userid' => $user->id]) }}">{{ $user->name }}</a>
                        </div>
                    </article>
                @endforeach
            @endif
            @if($result_type == 'song')
                @foreach($results as $song)
                    <article class="post">
                        <p>Title: {{ $song->title }}</p>
                        <p>Genre: {{ $song->genre }}</p>
                        <audio controls>
                            <source src="{{ route('get.song', ['path' => $song->path]) }}" type="audio/mpeg">
                        </audio><br>
                        @include("includes.interaction")
                    </article>
                @endforeach
            @endif
        </div>
    </section>
@endsection
