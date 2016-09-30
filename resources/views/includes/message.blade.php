@if(Session::has('message'))
    <div class="row">
        <div class="class col-md-4 col-md-offset-4">
            {{Session::get('message')}}
        </div>
    </div>
@endif
