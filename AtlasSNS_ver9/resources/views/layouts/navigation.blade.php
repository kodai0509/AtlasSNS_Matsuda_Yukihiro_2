<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <header x-data="{ open: false }">
        <div id="head">
            <a href="{{ route('posts.index') }}">
                <img src="{{ asset('images/atlas.png') }}" class="logo">
            </a>

            <div class="user-container">
                <div class="user-menu">
                    <p class="user-name">{{ Auth::user()->username }} さん</p>
                    <span @click="open = !open" class="arrow">
                        <span x-text="open ? '⌃' : '⌄'"></span>
                    </span>
                    <img class="rounded-circle user-icon" src="{{ asset('images/' . auth()->user()->icon_image) }}">
                </div>
                <!-- アコーディオンメニュー -->
                <ul x-show="open" x-cloak class="menu-list">
                    <li><a href="{{ route('posts.index') }}">ホーム</a></li>
                    <li><a href="{{ route('profiles.profile') }}">プロフィール編集</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">ログアウト</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</body>

</html>
