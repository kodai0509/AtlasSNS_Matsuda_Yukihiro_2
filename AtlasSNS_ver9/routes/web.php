<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/auth.php';

// ミドルウェア設定 (ログインしているユーザーのみアクセス可能なルート) //
Route::middleware('auth')->group(function () {
  // トップページのルート
  Route::get('/index', [PostsController::class, 'index'])->name('posts.index');

  // 認証ユーザーのプロフィールページ
  Route::get('/profile', [ProfileController::class, 'profile'])->name('profiles.profile');

  // 投稿の保存 (新しい投稿を保存)
  Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

  // 編集 (投稿の更新)
  Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');

  // 削除 (投稿の削除)
  Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');

  // プロフィール画面 (ユーザーのプロフィール編集画面)
  Route::get('/profile/{user}', [UsersController::class, 'show'])->name('profile.show');

  // 検索画面 (ユーザーの検索)
  Route::get('/search', [UsersController::class, 'search'])->name('search');

  // フォロー・フォロワーリストページ
  Route::get('/follow-list', [FollowsController::class, 'followList'])->name('follow.list');
  Route::get('/follower-list', [FollowsController::class, 'followerList'])->name('follower.list');

  // 相手ユーザーのプロフィールページ (ユーザーの詳細プロフィール)
  Route::get('/profile/{user}', [UsersController::class, 'show'])->name('profile.show');

  // フォロー機能 (フォロー・アンフォローの操作)
  Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('follow');
  Route::delete('/users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('unfollow');

  // 自身のプロフィール編集
  Route::put('/profile/update', [ProfileController::class, 'update'])->name('profiles.update');

  // ログアウト (ログアウトの処理)
  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// 登録 (新規ユーザー登録ページ)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログイン (ログインページ)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
