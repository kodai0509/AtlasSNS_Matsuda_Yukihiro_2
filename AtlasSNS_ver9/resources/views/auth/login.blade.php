<x-logout-layout>
  <section>
    <div class="title">
      <img src="images/atlas.png" alt="Atlas">
      <h1>Social Network Service</h1>
    </div>
    <!-- ログインフォーム部分 -->
    <div class="login-form">
      <h2>AtlasSNSへようこそ</h2>
      <!-- 適切なURLを入力してください -->
      {!! Form::open(['url' => route('login')]) !!}
      <div class="mail">
        <label>メールアドレス</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="password">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password">
      </div>
      <div class="login-btn">
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
