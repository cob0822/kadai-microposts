{!! Form::open(["route" => ["user.unsubscribing", $user->id], "method" => "delete"]) !!}
    {!! Form::submit("退会", ["class" => "btn btn-primary"]) !!}
{!! Form::close() !!}