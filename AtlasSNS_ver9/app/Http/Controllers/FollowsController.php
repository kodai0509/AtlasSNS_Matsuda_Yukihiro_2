<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;

class FollowsController extends Controller
{
    //フォローしているユーザーの表示
    public function followList()
    {
        // ログインしているユーザーの情報取得
        $user = Auth::user();

        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->following()->pluck('followed_id');

        // フォローしているユーザーの投稿表示
        $posts = Post::with('user')->whereIn('user_id', $following_id)->get();

        // フォローしているユーザーの情報取得
        $followingUsers = User::whereIn('id', $following_id)->get();

        return view('follows.followList', compact('user', 'posts', 'followingUsers'));
    }

    public function followerList()
    {
        // ログインしているユーザーの情報取得
        $user = Auth::user();

        // 自分をフォローしているユーザーのIDリストを取得
        $follower_ids = Follow::where('followed_id', $user->id)->pluck('following_id');

        // フォロワーのユーザー情報を取得
        $followerUsers = User::whereIn('id', $follower_ids)->get();

        // フォロワーの投稿を取得
        $posts = Post::with('user')->whereIn('user_id', $follower_ids)->get();

        return view('follows.followerList', compact('user', 'followerUsers', 'posts'));
    }

    public function show()
    {
        $user = Auth::user();
        // フォロー数のカウント
        $followCount = $user->following()->count();
        // フォロワー数のカウント
        $followerCount = $user->followers()->count();

        return view('login', compact('user', 'followCount', 'followerCount'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user(); // 現在ログインしているユーザーを取得

        // フォローしているか確認
        if (!$follower->isFollowing($user->id)) {
            // フォローしていない場合、フォローする
            $follower->follow($user->id);
        }

        return back(); // リダイレクトして元のページに戻る
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user(); // 現在ログインしているユーザーを取得

        // フォロー中か確認
        if ($follower->isFollowing($user->id)) {
            // フォローしている場合、フォロー解除
            $follower->unfollow($user->id);
        }

        return back(); // リダイレクトして元のページに戻る
    }
}
