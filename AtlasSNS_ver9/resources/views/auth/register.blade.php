<x-logout-layout>
    <!-- ロゴ配置修正 -->
    <div style="text-align: center; padding: 20px; margin-top: 50px;">

        <div style="font-family: sans-serif; color: white; margin-bottom: 20px;">
            <img src="images/atlas.png" alt="Atlas" style="height: 60px;">
            <h1>Social Network Service</h1>
        </div>

        <div style="background-color: rgba(255,255,255,0.8); padding: 30px; border-radius: 10px; width: 300px; margin: 0 auto;">
            <h2 style="font-size: 18px; font-weight: bold; margin-bottom: 20px;">新規ユーザー登録</h2>


            <!-- 適切なURLを入力してください -->
            {!! Form::open(['url' => '/register']) !!}

            <div style="margin-bottom: 20px;">
                {{ Form::label('ユーザー名') }}
                {{ Form::text('username',null,['class' => 'input', 'style' => 'width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;']) }}
                <!-- エラーメッセージ -->
                @if ($errors->has('username'))
                <p style="color: red; font-size: 12px;">{{ $errors->first('username') }}</p>
                @endif
            </div>

            <div style="margin-bottom: 20px;">
                {{ Form::label('メールアドレス') }}
                {{ Form::email('email',null,['class' => 'input', 'style' => 'width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;']) }}
                <!-- エラーメッセージ -->
                @if ($errors->has('email'))
                <p style="color: red; font-size: 12px;">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div style="margin-bottom: 20px;">
                {{ Form::label('パスワード') }}
                {{ Form::password('password', ['class' => 'input', 'style' => 'width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;']) }}
                <!-- エラーメッセージ -->
                @if ($errors->has('password'))
                <p style="color: red; font-size: 12px;">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div style="margin-bottom: 20px;">
                {{ Form::label('パスワード確認') }}
                {{ Form::password('password_confirmation', ['class' => 'input', 'style' => 'width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;']) }}
                <!-- エラーメッセージ -->
                @if ($errors->has('password_confirmation'))
                <p style="color: red; font-size: 12px;">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <div style="text-align: right;">
                {{ Form::submit('新規登録', ['style' => 'background-color: #ff6666; color: white; padding: 10px 20px; border-radius: 5px; border: none; font-weight: bold; cursor: pointer;']) }}
            </div>

            <p style="margin-top: 40px; text-align: center;">
                <a href="{{ route('login') }}" style="color: #0099ff;">ログイン画面へ戻る</a>
            </p>

            {!! Form::close() !!}

</x-logout-layout>
