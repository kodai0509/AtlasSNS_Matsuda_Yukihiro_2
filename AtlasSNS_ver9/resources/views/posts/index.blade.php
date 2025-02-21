<x-login-layout>
  <!-- 新しい投稿フォーム -->
  {!! Form::open(['route' => 'posts.store']) !!}
  <div class="form-group">
    <!-- アイコン表示 -->
    <img class="my-icon"
      src="{{ auth()->user()->icon_image && file_exists(storage_path('app/public/images/' . auth()->user()->icon_image))
          ? Storage::url('images/' . auth()->user()->icon_image)
          : asset('images/icon1.png') }}">
    <!-- 投稿フォーム -->
    <div class="textarea">
      {!! Form::textarea('newPost', null, ['class' => 'form-control', 'name' => 'newPost', 'required', 'placeholder' => '投稿内容を入力してください。']) !!}
    </div>
    <!-- 投稿ボタン -->
    <button type="submit" class="post-icon">
      <img src="{{ asset('images/post.png') }}">
    </button>
  </div>
  {!! Form::close() !!}

  <!-- 投稿一覧 -->
  <div class="post-index">
    @foreach($posts as $post)
    <ul>
      <li class="post-block">
        <div class="post-content">
          <figure class="users-icon">
            <img class="rounded-circle"
              src="{{ $post->user->icon_image && file_exists(storage_path('app/public/images/' . $post->user->icon_image))
            ? Storage::url('images/' . $post->user->icon_image): asset('images/icon1.png') }}">
          </figure>
          <div class="post-info">
            <div class="post-name">{{ $post->user->username }}</div>
            <div class="post">{{ $post->post }}</div>
          </div>
          <div class="date">{{ $post->created_at->format('Y-m-d H:i') }}</div>

          <!-- ログインユーザーの投稿にのみ編集・削除ボタンを表示 -->
          @if($post->user_id === auth()->id())
          <div class="post-actions">
            <!-- 編集アイコン -->
            <img src="{{ asset('images/edit.png') }}" class="edit-icon js-edit-button" data-id="{{ $post->id }}" data-content="{{ $post->post }}">

            <!-- 削除アイコン -->
            <a href="#" onclick="submitDeleteForm(event, {{ $post->id }})">
              <img src="{{ asset('images/trash-h.png') }}" class="delete" alt="削除">
            </a>
          </div>
          <!-- 削除フォーム -->
          <form id="delete-form-{{ $post->id }}" method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display: none;">
            @csrf
            @method('DELETE')
          </form>
          @endif
        </div>
      </li>
    </ul>
    @endforeach
  </div>

  <!-- 編集用モーダル -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form method="POST" action="" id="modal-edit-form">
        @csrf
        @method('PUT')
        <div class="textarea-wrapper">
          <textarea name="post" class="modal_post" id="modal-post-content"></textarea>
          <div class="icon-container">
            <button type="submit" class="edit-submit-btn">
              <img src="{{ asset('images/edit.png') }}" alt="更新">
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    // 編集モーダルを開く
    document.querySelectorAll('.js-edit-button').forEach(button => {
      button.addEventListener('click', function() {
        const modal = document.querySelector('.js-modal');
        const form = document.getElementById('modal-edit-form');
        const content = document.getElementById('modal-post-content');

        // 投稿情報をモーダルに設定
        content.value = this.dataset.content;
        form.action = `/posts/${this.dataset.id}`;

        // モーダルを表示
        modal.style.display = 'block';
      });
    });

    // モーダルを閉じる
    document.querySelectorAll('.js-modal-close').forEach(button => {
      button.addEventListener('click', function() {
        const modal = document.querySelector('.js-modal');
        modal.style.display = 'none';
      });
    });

    // 削除フォームを送信
    function submitDeleteForm(event, postId) {
      event.preventDefault();
      if (confirm('こちらの投稿を削除してもよろしいでしょうか？')) {
        document.getElementById(`delete-form-${postId}`).submit();
      }
    }
  </script>
</x-login-layout>
