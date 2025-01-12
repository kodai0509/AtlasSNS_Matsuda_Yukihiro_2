<x-login-layout>
  <!-- 自分かその他のユーザーの分岐 -->
  @if(auth()->id() == $user->id)
  <!-- ログインユーザーの場合 -->
  <div class="profile-edit">
    <!-- アイコン表示 -->
    <div class="my-icon">
      <img class="rounded-circle" src="{{ Storage::url('images/' . (auth()->user()->icon_image ?? 'icon1.png')) }}">
    </div>
    <form action="{{ route('profiles.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- ユーザー名編集 -->
      <div class="name-edit">
        <label for="username">ユーザー名</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
      </div>

      <!-- メールアドレス編集 -->
      <div class="mail-edit">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
      </div>

      <!-- 自己紹介文編集 -->
      <div class="bio-edit">
        <label for="bio">自己紹介文</label>
        <input type="text" id="bio" name="bio" rows="4" value="{{ old('bio', $user->bio) }}">
      </div>

      <!-- パスワード -->
      <div class="password-edit">
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password">
      </div>

      <!-- パスワード確認 -->
      <div class="password-confirmation">
        <label for="password_confirmation">パスワード確認</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
      </div>

      <!-- アイコン -->
      <div class="icon-edit">
        <label for="icon_image">アイコン画像</label>
        <input type="file" id="icon_image" name="icon_image">
      </div>

      <!-- 保存ボタン -->
      <div class="edit-button">
        <button type="submit" class="btn btn-success">更新</button>
      </div>
    </form>
  </div>
  @else

  <!-- その他のユーザーの場合 -->
  <div class="profile-group">
    <!-- ユーザーアイコン -->
    <figure class="profile-icon">
      <img class="rounded-circle" src="{{
                $user->icon_image && file_exists(storage_path('app/public/images/' . $user->icon_image)) ? Storage::url('images/' . $user->icon_image) : asset('images/icon1.png') }}">
    </figure>

    <!-- ユーザー情報 -->
    <div class="profile-details">
      <div class="username">
        <span>ユーザー名</span>
        <span class="user-name"> {{ $user->username }}</span>
      </div>
      <div class="user_profile">
        <span>自己紹介</span>
        <span class="user-profile">{{ $user->bio }}</span>
      </div>
    </div>

    <!-- フォローボタン -->
    <div class="follow-btn">
      @if (auth()->user()->isFollowing($user->id))
      <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">フォロー解除</button>
      </form>
      @else
      <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">フォローする</button>
      </form>
      @endif
    </div>
  </div>
  @endif

  <!-- 投稿一覧表示 -->
  <div class="users-post">
    @foreach($posts as $post)
    <ul>
      <li class="post-block">
        <div class="post-header">
          <figure class="users-icon">
            <img class="rounded-circle" src="{{
                            $post->user->icon_image && file_exists(storage_path('app/public/images/' . $post->user->icon_image))
                            ? Storage::url('images/' . $post->user->icon_image) : asset('images/icon1.png') }}">
          </figure>
          <div class="post-details">
            <div class="users-name">{{ $post->user->username }}</div>
            <div class="users-post">{{ $post->post }}</div>
          </div>
        </div>
        <div class="date">{{ $post->created_at }}</div>
      </li>
    </ul>
    @endforeach
  </div>
</x-login-layout>
