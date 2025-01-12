<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    // 一覧表示
    public function index()
    {
        // ログインユーザー情報取得
        $user = Auth::user();

        // フォローしているユーザーのIDを取得
        $following_id = Auth::user()->following()->pluck('followed_id');

        //自分の及びフォローしているの投稿を表示
        $posts = Post::with('user')
            ->whereIn('user_id', $following_id)
            ->orWhere('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // フォロー数・フォロワー数を取得
        $followCount = $user->following()->count();
        $followerCount = $user->followers()->count();

        return view('posts.index', compact('user', 'posts', 'followCount', 'followerCount'));
    }

    // 新規ポスト入力
    public function create()
    {
        // 後で
    }

    // 新規ポスト処理
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'newPost' => 'required|string|max:150',
        ]);

        // 新しい投稿を作成
        $post = new Post();
        $post->post = $validated['newPost'];
        $post->user_id = auth()->id();

        $post->save();

        return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
    }

    // 編集
    public function update(Request $request, $id)
    {
        // バリデーション（150文字まで）
        $validated = $request->validate([
            'post' => 'required|string|max:150',
        ]);

        // 投稿を取得
        $post = Post::find($id);

        // 投稿が見つからない場合の処理
        if (!$post) {
            return redirect()->route('posts.index')->with('error', '投稿が見つかりません')->setStatusCode(404);
        }

        // 自分の投稿のみ編集できるようにする
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', '権限がありません')->setStatusCode(403);
        }

        // 投稿内容を更新
        $post->post = $validated['post'];
        $post->save();

        // TOPページにリダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が更新されました！');
    }

    // 削除
    public function destroy($id)
    {

        // 投稿を取得
        $post = Post::find($id);

        // 自分の投稿のみ削除できるようにする
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', '権限がありません')->setStatusCode(403);
        }

        // 投稿を削除
        $post->delete();

        // TOPページにリダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が削除されました！');
    }
}
