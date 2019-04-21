@if(Auth::user()->is_favorite($micropost->id))
    {!! Form::open(["route" => ["post.unfavorite", $micropost->id], "method" => "delete"]) !!}
        {!! Form::submit("お気に入り解除", ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(["route" => ["post.favorite", $micropost->id]]) !!}
        {!! Form::submit("お気に入り登録", ["class" => "btn btn-primary btn-sm"]) !!}
    {!! Form::close() !!}
@endif
