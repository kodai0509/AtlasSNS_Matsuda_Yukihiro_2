<x-login-layout>
  <!-- フォローリストのアイコン表示 -->
  <div class="follow-icons">
    @foreach($followingUsers as $follow)
    <a href="{{ route('profile.show', ['user' => $follow->id]) }}">
      <img class="icon"
        src="{{ $follow->icon_image && file_exists(storage_path('app/public/images/' . $follow->icon_image)) ? Storage::url('images/' . $follow->icon_image) : asset('images/icon1.png') }}"
        alt="{{ $follow->username }}のアイコン">
    </a>
    @endforeach
  </div>

  <!-- 自分がフォローしているユーザーを表示 -->
  <div class="follow-index">
    @foreach($posts as $post)
    <ul>
      <li class="post-block">
        <div class='follow-content'>
          <figure class="follow-icon">
            <a href="{{ route('profile.show', ['user' =>  $post->user->id]) }}">
              <img class="rounded-circle"
                src="{{ $post->user->icon_image && file_exists(storage_path('app/public/images/' . $post->user->icon_image))
                         ? Storage::url('images/' . $post->user->icon_image)
                         : asset('images/icon1.png') }}"
                alt="{{ $post->user->username }}のアイコン">
            </a>
          </figure>
          <div class="follow-info">
            <div class='follow-name'>{{ $post->user->username }}</div>
            <div class='follow-post'>{{ $post->post }}</div>
          </div>
        </div>
        <div class="date">{{ $post->created_at }}</div>
      </li>
    </ul>
    @endforeach
  </div>
</x-login-layout>
