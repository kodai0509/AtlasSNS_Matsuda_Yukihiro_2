<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>

  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>

    <div id="side-bar">
      <div id="confirm">
        <p>{{ Auth::user()->username }}さんの</p>
        <div class="follow-count">
          <p>フォロー数 {{ $followCount }}名</p>
        </div>
        <div class="follow-list">
          <button type="button" class="btn btn-primary">
            <a href="{{ route('follow.list') }}">フォローリスト</a>
          </button>
        </div>
        <div class="follower-count">
          <p>フォロワー数 {{ $followerCount }}名</p>
        </div>
        <div class="follower-list">
          <button type="button" class="btn btn-primary">
            <a href="{{ route('follower.list') }}">フォロワーリスト</a>
          </button>
        </div>
        <hr class="divider">
        <!-- ユーザー検索ボタン -->
        <div class="search-button-wrapper">
          <button type="button" class="btn btn-primary">
            <a href="{{ route('search') }}">ユーザー検索</a>
          </button>
        </div>
      </div>
    </div>

    <footer>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>


</html>
