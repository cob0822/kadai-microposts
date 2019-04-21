@if(count($posts) >0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="media">
                <img class="mr-2 rounded" src="{{Gravatar::src($user->email, 50)}}" alt="">
                <div class="media-body">
                    <div>
                        {{$user->name}}
                    </div>
                    <div>
                        <p>{!! link_to_route("users.show", "View profile", ["id" => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
        <!--  ポスト内容の表示
        @if(count($posts) > 0)
            @include("microposts.microposts", ["microposts" => $microposts])
        @endif
        -->
    </ul>
    {{$users->render("pagination::bootstrap-4")}}
@endif