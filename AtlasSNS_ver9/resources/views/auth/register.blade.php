<x-logout-layout>
    <section>
        <div class="title">
            <img src="images/atlas.png" alt="Atlas">
            <h1>Social Network Service</h1>
        </div>
        <div class="register-form">
            <h2>新規ユーザー登録</h2>
            <form>
                {!! Form::open(['url' => '/register']) !!}
                <div class="name-register">
                    <label for="username">ユーザー名</label>
                    <input type="text" id="username" name="username" required>
                    <!-- エラーメッセージ -->
                    @if ($errors->has('username'))
                    <p style="color: red; font-size: 12px;">{{ $errors->first('username') }}</p>
                    @endif
                </div>
                <div class="mail-register">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" required>
                    <!-- エラーメッセージ -->
                    @if ($errors->has('email'))
                    <p style="color: red; font-size: 12px;">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="password-register">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password">
                    <!-- エラーメッセージ -->
                    @if ($errors->has('password'))
                    <p style="color: red; font-size: 12px;">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="password_confirmation-register">
                    <label for="password_confirmation">パスワード確認</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                    <!-- エラーメッセージ -->
                    @if ($errors->has('password_confirmation'))
                    <p style="color: red; font-size: 12px;">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
                <div class="register-btn">
                    <button type="submit" class="btn btn-register">新規登録</button>
                </div>
                {!! Form::close() !!}
            </form>
        </div>
    </section>
</x-logout-layout>
