<x-logout-layout>
  <!-- ロゴ位置修正 -->
  <div style="text-align: center; padding: 20px; margin-top: 50px;">

    <div style="font-family: sans-serif; color: white; margin-bottom: 20px;">
      <img src="images/atlas.png" alt="Atlas" style="height: 60px;">
      <h1 style="font-size: 24px; font-weight: bold;">Atlas</h1>
      <h2 style="font-size: 18px;">Social Network Service</h2>
    </div>

    @auth
    <div style="background-color: rgba(255,255,255,0.8); padding: 30px; border-radius: 10px; width: 300px; margin: 0 auto;">

      <h2 style="font-size: 18px; font-weight: bold; color: #0099ff; background-color: #e0e0e0; display: inline-block; padding: 5px 10px; border-radius: 5px;">
        {{ session('username') }}さん
      </h2>

      <p style="margin-top: 10px; color: black; font-size: 16px;">
        ようこそ！ AtlasSNSへ
      </p>

      <div style="margin-top: 20px;">
        <p style="color: black; font-size: 14px;">
          ユーザー登録が完了しました。</br>
          早速ログインをしてみましょう。
        </p>
      </div>

      <div style="margin-top: 20px;">
        <a href="{{ route('login') }}" style="display: block; width: 100%; text-align: center; background-color: #ff6666; color: white; padding: 10px; border-radius: 5px; font-weight: bold; text-decoration: none;">
          ログイン画面へ
        </a>
      </div>
    </div>
  </div>
  @endauth

</x-logout-layout>
