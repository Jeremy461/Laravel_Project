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
                @if($results->count() == 0)
                    <p>No search results</p>
                @endif
                        @foreach($genres as $genre)
                            <input type="checkbox" checked="true" name="{{ $genre->name }}" value="{{ $genre->id }}"> {{ $genre->name }}<br>
                        @endforeach
                    <br>
                    @foreach($results as $song)
                            <article class="post">
                                <p>Title: {{ $song->title }}</p>
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
