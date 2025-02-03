<x-logout-layout>
  <section>
    <div class="title">
      <img src="images/atlas.png" alt="Atlas">
      <h1>Social Network Service</h1>
    </div>
    <div class="added-message">
      <div class="added-message01">
        <p> {{ session('username') }}さん </br>
          ようこそ！ AtlasSNSへ
        </p>
      </div>
      <div class="added-message02">
        <p>
          ユーザー登録が完了しました。</br>
          早速ログインをしてみましょう!
        </p>
      </div>
      <div class="login-btn02">
        <a href="{{ route('login') }}">ログイン画面へ</a>
      </div>
    </div>
  </section>
</x-logout-layout>
