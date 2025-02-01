<x-logout-layout>
  <section>
    <div class="title">
      <img src="images/atlas.png" alt="Atlas" style="height: 60px;">
      <h1>Social Network Service</h1>
    </div>
    <div class="login-form">
      <h2>AtlasSNSへようこそ</h2>
      <!-- 適切なURLを入力してください -->
      {!! Form::open(['url' => route('login')]) !!}
      <div class="mail">
        {{ Form::label('email', 'メールアドレス', ['style' => 'display: block; font-weight: bold; color: black;']) }}
        {{ Form::text('email', null, ['class' => 'input']) }}
      </div>
      <div class="password">
        {{ Form::label('password', 'パスワード', ['style' => 'display: block; font-weight: bold; color: black;']) }}
        {{ Form::password('password', ['class' => 'input']) }}
      </div>
      <div class="logon-btn">
        <button type="submit" class="btn btn-login">ログイン</button>
      </div>
      {!! Form::close() !!}
      <div class="new-user">
        <a href="{{ route('register') }}">新規ユーザーの方はこちら</a>
      </div>
    </div>
  </section>
  <!-- デバッグ処理 -->
  <!-- <pre>{{ print_r(session()->all(), true) }}</pre> -->
</x-logout-layout>
