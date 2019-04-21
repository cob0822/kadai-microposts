@if(Auth::user()->is_favorite($micropost->id))
    {!! Form::open(["route" => ["post.unfavorite", $micropost->id], "method" => "delete"]) !!}
        {!! Form::submit("Unfavorite", ["class" => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(["route" => ["post.favorite", $micropost->id]]) !!}
        {!! Form::submit("Favorite", ["class" => "btn btn-primary btn-sm"]) !!}
    {!! Form::close() !!}
@endif
