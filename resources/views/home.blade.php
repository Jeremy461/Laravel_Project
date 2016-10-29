@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{Session::get('message')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user())
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Upload your music!</h3></header>
            <form action="{{ route('upload.song') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                    <label for="song">Song</label>
                    <input type="file" name="song" class="form-control" id="song">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" class="form-control" id="genre">
                </div>
                <button type="submit" class="btn btn-primary">Upload song</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    @endif
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Uploads</h3></header>
            @foreach($songs as $song)
                <article class="post">
                    <p>Title: {{ $song->title }}</p>
                    <audio controls>
                        <source src="{{ route('get.song', ['path' => $song->path]) }}" type="audio/mpeg">
                    </audio><br>
                    Posted by <a href="{{ route('getProfile', ['userid' => $song->user->id]) }}">{{ $song->user->name }}</a>
                    @include("includes.interaction")
                </article>
            @endforeach
        </div>
    </section>
@endsection
