@extends('layouts.app')

@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Search results</h3></header>
            @foreach($results as $user)
                <article class="post">
                    <div class="info">
                        <a href="{{ route('getProfile', ['userid' => $user->id]) }}">{{ $user->name }}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
