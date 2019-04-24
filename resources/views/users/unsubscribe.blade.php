@extends("layouts.app")

@section("content")
    <div class="mb-4">
        <h2>退会画面</h2>
    </div>
    <div class="row">
        <aside class="col-sm-4">
            @include("users.card", ["user" => $user])
            <div class="mt-2">
                <p>{{$user->profile}}</p>
            </div>
        </aside>
        <div class="col-sm-8">
            <p>以下の登録ユーザー情報を削除します。確認後、「退会」ボタンを押してください。</p>
            <table class="table table-striped table-bordered">
                <tr>
                    <td>ユーザー名</td>
                    <td>メールアドレス</td>
                </tr>
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            </table>
            @include("user_unsubscribe.unsubscribe_button", ["id" => $user->id])
        </div>
    </div>
@endsection