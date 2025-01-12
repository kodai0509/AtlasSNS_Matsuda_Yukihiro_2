<x-login-layout>
  <!-- フォロワーリストのアイコン表示 -->
  <div class="follower-icons">
    @foreach($followerUsers as $follower)
    <a href="{{ route('profile.show', ['user' => $follower->id]) }}">
      <img class="icon"
        src="{{ $follower->icon_image && file_exists(storage_path('app/public/images/' . $follower->icon_image)) ? Storage::url('images/' . $follower->icon_image): asset('images/icon1.png') }}">
    </a>
    @endforeach
  </div>

  <!-- 自分をフォローしている人の投稿一覧 -->
  <div class="follower-index">
    @foreach($posts as $post)
    <ul>
      <li class="post-block" style="position: relative;">
        <div class="follower-content">
          <figure class="follower-icon">
            <a href="{{ route('profile.show', ['user' => $post->user->id]) }}">
              <img class="rounded-circle"
                src="{{ $post->user->icon_image && file_exists(storage_path('app/public/images/' . $post->user->icon_image))
                                  ? Storage::url('images/' . $post->user->icon_image)
                                  : asset('images/icon1.png') }}"
                alt="{{ $post->user->username }}のアイコン">
            </a>
          </figure>
          <div class="follower-info">
            <div class="follower-name">{{ $post->user->username }}</div>
            <div class="follower-post">{{ $post->post }}</div>
          </div>
        </div>
        <div class="date"> {{ $post->created_at }} </div>
      </li>
    </ul>
    @endforeach
  </div>

</x-login-layout>
