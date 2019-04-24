@extends("layouts.app")

@section("content")
    <div class="mb-4">
        <h2>プロフィール編集</h2>
    </div>
    <div class="row">
        <aside class="col-sm-4">
            @include("users.card", ["user" => $user])
            <div class="mt-2">
                <p>{{$user->profile}}</p>
            </div>
        </aside>
        <div class="col-sm-8">
            {!! Form::open(["route" => ["user.changeProfile", $user->id]]) !!}
                {!! Form::textarea("profile", old("profile"), ["class" => "form-control"]) !!}
                <div class="row mt-2">
                    <div class="col-2 col-md-1">
                    {!! Form::submit("変更", ["class" => "btn btn-primary"]) !!}
                    </div>
                {!! Form::close() !!}
                
                    <div class="col">
                    {!! Form::open(["route" => ["user.destroyProfile", $user->id], "method" => "delete"]) !!}
                        {!! Form::submit("削除", ["class" => "btn btn-danger"]) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
        </div>
    </div>
@endsection