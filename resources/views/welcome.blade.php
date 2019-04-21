@extends("layouts.app")

@section("content")
    @if(Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="form-group mb-3">
                    @include("users.card", ["user" => Auth::user()])
                    <div class="mt-2">
                        @if(Auth::id() == $user->id)
                            {!! Form::open(["route" => "microposts.store"]) !!}
                                    {!! Form::textarea("content", old("content"), ["class" => "form-control", "rows" => "2"]) !!}
                                    {!! Form::submit("投稿", ["class" => "btn btn-primary btn-block"]) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                @if(count($microposts)>0)
                    @include("microposts.microposts", ["microposts" => $microposts])
                @endif
        </div>
    </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                <div class="mt-4">
                    {!! link_to_route("signup.get", "ユーザー登録", [], ["class" => "btn btn-lg btn-primary"]) !!}
                </div>
            </div>
        </div>
    @endif
@endsection
    