<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\Post;

class ProfileController extends Controller
{
    // プロフィール一覧
    public function profile($id = null)
    {
        // 表示するユーザーを特定
        $user = $id ? User::findOrFail($id) : Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // フォロー数とフォロワー数を取得
        $followCount = $user->following()->count();
        $followerCount = $user->followers()->count();

        // ポストを表示
        if (Auth::id() === $user->id) {
            // 自分の投稿は表示しない
            $posts = collect();
        } else {
            $posts = Post::with('user')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('profiles.profile', compact('user', 'followCount', 'followerCount', 'posts'));
    }

    // 自身のプロフィール編集
    public function update(Request $request)
    {
        $user = Auth::user();

        // バリデーション
        $validated = $request->validate([
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|email|min:5|max:40|unique:users,email,' . $user->id,
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|confirmed',
            'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
            'bio' => 'nullable|string|max:150',
            'icon_image' => 'nullable|mimes:jpg,png,bmp,gif,svg|max:2048',
        ]);

        // プロフィール更新
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? '';

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        if ($request->hasFile('icon_image')) {
            $filename = $request->file('icon_image')->store('images', 'public');
            $user->icon_image = basename($filename);
        }

        $user->save();

        return redirect()->route('posts.index');
    }
}
