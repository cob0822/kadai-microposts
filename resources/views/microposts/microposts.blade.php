<ul class="list-unstyled">
    @foreach($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{Gravatar::src($micropost->user->email, 50)}}" alt="">
            <div class="media-body">
                    <div>
                        {!! link_to_route("users.show", $micropost->user->name, ["id" => $micropost->user->id]) !!} <span class="text-muted">posted at {{$micropost->created_at}}</span>
                    </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div class="row">
                    <div class="col-5 col-md-2">
                        @include("post_favorites.favorite_button")
                    </div>
                    <div class="col">
                        @if(Auth::id() == $micropost->user_id)
                            {!! Form::open(["route" => ["microposts.destroy", $micropost->id], "method" => "delete"]) !!}
                                {!! Form::submit("削除", ["class" => "btn btn-danger btn-sm"]) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{$microposts->render("pagination::bootstrap-4")}}