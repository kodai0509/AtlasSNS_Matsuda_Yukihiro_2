<x-login-layout>
  @section('content')
  <!-- 検索フォーム -->
  <div class="search-form">
    <form action="{{ route('search') }}" method="GET" class="mb-4">
      <input type="text" name="keyword" class="form" placeholder="ユーザー名"
        value="{{ request('keyword') }}">
      <button type="submit" class="search-icon">
        <img src="{{ asset('images/search.png') }}">
      </button>
    </form>
    <!-- 検索ワードの表示 -->
    @if(!empty(request('keyword')))
    <div class="search-result">
      <p>検索ワード: <strong>{{ request('keyword') }}</strong></p>
    </div>
    @endif
  </div>

  <div class="user-index">
    @foreach ($users as $user)
    <ul>
      <li class="user-item">
        <div class="user-info">
          <a href="{{ route('profile.show', ['user' => $user->id]) }}">
            <!-- アイコン画像の表示 -->
            <img class="icon"
              src="{{$user->icon_image && file_exists(storage_path('app/public/images/' . $user->icon_image))? Storage::url('images/' . $user->icon_image): asset('images/icon1.png') }}">
          </a>
          <p class="user-name">{{ $user->username }}</p>
        </div>
        <div class="follow-btn">
          @if (auth()->user()->isFollowing($user->id))
          <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              フォロー解除
            </button>
          </form>
          @else
          <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
              フォローする
            </button>
          </form>
          @endif
        </div>
      </li>
    </ul>
    @endforeach
  </div>
</x-login-layout>
