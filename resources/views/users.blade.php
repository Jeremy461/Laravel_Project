@extends('layouts.app')

@section('content')
    @foreach($results as $user)
        <section class="row posts">
            <div class="col-md-6 col-md-offset-3">
                <article class="post">
                    <div class="info">
                        <a href="{{ route('getProfile', ['userid' => $user->id]) }}">{{ $user->name }}</a>
                    </div>
                </article>
                {!! Form::open(array('route' => array('delete.user', $user->id))) !!}
                <button type="submit" class="button">Delete user</button>
                {!! Form::close() !!}
            </div>
        </section>
    @endforeach
@endsection
