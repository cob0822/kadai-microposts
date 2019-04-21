@if(count($users) >0)
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li class="media mt-3">
                <img class="mr-2 rounded" src="{{Gravatar::src($user->email, 50)}}" alt="">
                <div class="media-body">
                    <div>
                        <p>{!! link_to_route("users.show", $user->name, ["id" => $user->id]) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{$users->render("pagination::bootstrap-4")}}
@endif