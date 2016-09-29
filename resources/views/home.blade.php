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

    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Place a post!</h3></header>
            {!! Form::open(['route' => 'create.post']) !!}
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="New post"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create post</button>
            {!! Form::close() !!}
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Other posts</h3></header>
            <article class="post">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A eligendi error expedita harum ut? Assumenda deleniti deserunt, dicta dolorum eius fuga impedit in ipsum obcaecati, pariatur porro quisquam quod repellat!</p>
                <div class="info">
                    Posted by "naam" on "datum"
                </div>
                <div class="interaction">
                    <a href="#">Like</a>
                    <a href="#">Dislike</a>
                    <a href="#">Edit</a>
                    <a href="#">Delete</a>
                </div>
            </article>
        </div>
    </section>
@endsection
