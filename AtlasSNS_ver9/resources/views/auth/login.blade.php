<x-logout-layout>

  <!-- ロゴ配置修正 -->
  <div style="text-align: center; padding: 20px; margin-top: 50px;">

    <div style="font-family: sans-serif; color: white; margin-bottom: 20px;">
      <img src="images/atlas.png" alt="Atlas" style="height: 60px;">
      <h1>Social Network Service</h1>
    </div>

    <div style="background-color: rgba(255,255,255,0.8); padding: 30px; border-radius: 10px; width: 300px; margin: 0 auto;">
      <h2 style="font-size: 18px; font-weight: bold;">AtlasSNSへようこそ</h2>

      <!-- 適切なURLを入力してください -->
      {!! Form::open(['url' => route('login')]) !!}

      <div style="margin-bottom: 20px;">
        {{ Form::label('email', 'メールアドレス', ['style' => 'display: block; font-weight: bold; color: black;']) }}
        {{ Form::text('email', null, ['class' => 'input', 'style' => 'width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;']) }}
      </div>

      <div style="margin-bottom: 20px;">
        {{ Form::label('password', 'パスワード', ['style' => 'display: block; font-weight: bold; color: black;']) }}
        {{ Form::password('password', ['class' => 'input', 'style' => 'width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc;']) }}
      </div>

      <div>
        {{ Form::submit('ログイン', ['style' => 'width: 100%; background-color: #ff6666; color: white; padding: 10px; border-radius: 5px; border: none; font-weight: bold;']) }}
      </div>

      {!! Form::close() !!}

      <!-- 新規ユーザー登録 -->
      <p style="margin-top: 10px;">
        <a href="{{ route('register') }}">新規ユーザーの方はこちら</a>
      </p>

      <!-- デバッグ処理 -->
      <!-- <pre>{{ print_r(session()->all(), true) }}</pre> -->


</x-logout-layout>
